const state = {
	colstartblockproducts: 20,

	ids: [],

	api_src: null,
	products: [],

	isLoading: true,
	addSaveTovarTrashMethodCol: 1,
	addSaveTovarTrashMethodToggle: true,

	page: 0,

	loadTriggerElement: null,

	localStorageFavorite: 'favorite',
	localStorageTrash: 'trash',
	localStorageHistory: 'history_products',

	isMessage: false,
	message: null,

	methods: 'get',

	isActiveSearchHint: false,

	saveTovarFavorites: [],
	saveTovarTrash: [],
	saveTovarHistories: [],

	countTrashTovars: 0,
	countFavoriteTovars: 0,
}


const getters = {
	colstartblockproducts: (state) => state.colstartblockproducts,
	ids: (state) => state.ids,
	api_src: (state) => state.api_src,
	addSaveTovarTrashMethodCol: (state) => state.addSaveTovarTrashMethodCol,
	addSaveTovarTrashMethodToggle: (state) => state.addSaveTovarTrashMethodToggle,
	products: (state) => state.products,
	isLoading: (state) => state.isLoading,
	page: (state) => state.page,
	loadTriggerElement: (state) => state.loadTriggerElement,
	localStorageFavorite: (state) => state.localStorageFavorite,
	localStorageTrash: (state) => state.localStorageTrash,
	localStorageHistory: (state) => state.localStorageHistory,
	isMessage: (state) => state.isMessage,
	message: (state) => state.message,
	methods: (state) => state.methods,
	isActiveSearchHint: (state) => state.isActiveSearchHint,
	saveTovarFavorites: (state) => state.saveTovarFavorites,
	saveTovarHistories: (state) => state.saveTovarHistories,
	saveTovarTrash: (state) => state.saveTovarTrash,
	saveTovarTrashIds: (state) => state.saveTovarTrash.map(item => item.id),
	countTrashTovars: (state) => (state.saveTovarTrash.length > 99 ? '99+' : state.saveTovarTrash.length),
	countFavoriteTovars: (state) => (state.saveTovarFavorites.length > 99 ? '99+' : state.saveTovarFavorites.length),
}

const actions = {
	zeroingProducts({ commit, getters, dispatch }){
		commit('setIsMessage', false);
		commit('setProducts', []);
		commit('setIsLoading', true);
		commit('setPage', 0);
	},
	initializeProducts({ commit, getters, dispatch }) {
		dispatch('getProducts');
	},
	loadMoreButton({ commit, dispatch }) {
		dispatch('getProducts');
	},
	async getProducts({ commit, getters, dispatch,
	 state }) {
		if (state.cancelTokenSource) {
			state.cancelTokenSource.cancel("Request canceled");
		}
		if (getters.methods == 'post' && getters.ids.length == 0) {
			commit('setIsMessage', true)
			commit("setIsLoading", false);
			return;
		}
		commit('setPage', getters.page + 1)
		try {
			let response = '';
			let pageNumberFragment = '?page=';
			if (getters.api_src.includes('?')) {
				pageNumberFragment = '&page=';
			}
			if (getters.methods == 'get') {
				response = await axios.get('/api/' + getters.api_src + pageNumberFragment + getters.page);
			} else if (getters.methods == 'post') {
				response = await axios.post('/api/' + getters.api_src + pageNumberFragment + getters.page, {productIds: getters.ids});
			}
			if (response && response.data && response.data.length > 0) {
				if (getters.page == 1) {
					commit("setProducts", []);
					commit("setProducts", response.data);
				} else {
					let products = getters.products;
					products.push(...response.data);
					commit("setProducts", products);
				}
			} else {
				if (getters.products.length > 0) {
					commit("setIsLoading", false);
				} else {
					commit('setIsMessage', true)
					commit("setIsLoading", false);
				}
			}
		} catch (error) {
			if (getters.products.length > 0) {
				commit('setIsMessage', true)
				commit("setIsLoading", false);
			}
		}
	},
	setSaveTovarHistory({ getters, commit, dispatch }, productId) {
		let products = getters.saveTovarHistories;
		if (products.length == 0) {
			let data = [productId];
			localStorage.setItem(getters.localStorageHistory, JSON.stringify(data));
			commit("setSaveTovarHistories", data)
		} else {
			let status = products.indexOf(productId);
			if (status == -1) {
				products.push(productId);
			}
			localStorage.setItem(getters.localStorageHistory, JSON.stringify(products));
			commit("setSaveTovarHistories", products);
		}
	},
	setSaveTovarFavorite({ getters, commit, dispatch }, productId) {
		let products = getters.saveTovarFavorites;
		if (products.length == 0) {
			let data = [productId];
			localStorage.setItem(getters.localStorageFavorite, JSON.stringify(data));
			commit("setSaveTovarFavorites", data)
		} else {
			let status = products.indexOf(productId);
			if (status == -1) {
				products.push(productId);
			} else {
				products.splice(status, 1);
			}
			localStorage.setItem(getters.localStorageFavorite, JSON.stringify(products));
			commit("setSaveTovarFavorites", products);
		}
	},
	addSaveTovarTrashToggle({ getters, commit, dispatch }, productId) {
		commit("setAddSaveTovarTrashMethodCol", 1)
		commit("setAddSaveTovarTrashMethodToggle", true)
		dispatch("addSaveTovarTrash", productId)
	},
	addSaveTovarTrashAdd({ getters, commit, dispatch }, productId) {
		commit("setAddSaveTovarTrashMethodToggle", false)
		dispatch("addSaveTovarTrash", productId)
	},
	addSaveTovarTrash({ getters, commit, dispatch }, productId) {
		let products = getters.saveTovarTrash;
		let data = [
			{
				'id': Number(productId),
				'col': Number(getters.addSaveTovarTrashMethodCol)
			}
		];
		if (products.length == 0) {
			localStorage.setItem(getters.localStorageTrash, JSON.stringify(data));
			commit("setSaveTovarTrash", data)
		} else {
			let productIds = [];
			products.forEach(item => {
				productIds.push(item.id)
			});
			let status = productIds.indexOf(productId);
			if (getters.addSaveTovarTrashMethodToggle) {
				if (status == -1) {
					Array.prototype.push.apply(products, data);
				} else {
					products.splice(status, 1);
				}
			} else {
				if (status != -1) {
					products.splice(status, 1);
					Array.prototype.push.apply(products, data);
				}
			}
			dispatch("updateSaveTovarTrash", products);
		}
	},
	updateSaveTovarTrash({ commit, getters }, products) {
		commit("setSaveTovarTrash", products);
		localStorage.setItem(getters.localStorageTrash, JSON.stringify(products));
	},
	scanLocalStorageHistory({ getters, dispatch }) {
		if (!localStorage.getItem(getters.localStorageHistory)) {
			return false;
		}
		if (!Array.isArray(JSON.parse(localStorage.getItem(getters.localStorageHistory)))) {
			localStorage.removeItem(getters.localStorageHistory);
			return false;
		}
		let productIds = JSON.parse(localStorage.getItem(getters.localStorageHistory));
		productIds = productIds.filter(Number);
		localStorage.setItem(getters.localStorageHistory, JSON.stringify(productIds));
		dispatch("getLocalStorageHistory")
	},
	scanLocalStorageFavorite({ getters, dispatch }) {
			if (!localStorage.getItem(getters.localStorageFavorite)) {
				return false;
			}
			if (!Array.isArray(JSON.parse(localStorage.getItem(getters.localStorageFavorite)))) {
				localStorage.removeItem(getters.localStorageFavorite);
				return false;
			}
			let productIds = JSON.parse(localStorage.getItem(getters.localStorageFavorite));
			productIds = productIds.filter(Number);
			localStorage.setItem(getters.localStorageFavorite, JSON.stringify(productIds));
			dispatch("getLocalStorageFavorite")

	},
	scanLocalStorageTrash({ getters, dispatch }) {
		if (!localStorage.getItem(getters.localStorageTrash)) {
			return false;
		}
		if (!Array.isArray(JSON.parse(localStorage.getItem(getters.localStorageTrash)))) {
			localStorage.removeItem(getters.localStorageTrash);
			return false;
		}
		let products = JSON.parse(localStorage.getItem(getters.localStorageTrash));
		products = products.filter(item => typeof item.id === 'number' && typeof item.col === 'number');
		localStorage.setItem(getters.localStorageTrash, JSON.stringify(products));
		dispatch("getLocalStorageTrash")
	},
	getLocalStorageHistory({ commit, getters }) {
		let data = JSON.parse(localStorage.getItem(getters.localStorageHistory));
		if (data) {
			commit("setSaveTovarHistories", data)
		}
	},
	getLocalStorageFavorite({ commit, getters }) {
		let data = JSON.parse(localStorage.getItem(getters.localStorageFavorite));
		if (data) {
			commit("setSaveTovarFavorites", data)
		}
	},
	getLocalStorageTrash({ commit, getters }) {
		let data = JSON.parse(localStorage.getItem(getters.localStorageTrash));
		if (data) {
			commit("setSaveTovarTrash", data)
		}
	},
	getIds({ commit, getters }, param = null) {
		switch (param) {
			case 'favorite':
				commit("setIds", getters.saveTovarFavorites)
				break;
			case 'history':
				commit("setIds", getters.saveTovarHistories)
				break;
			case 'trash':
				let productIds = [];
				getters.saveTovarTrash.forEach(item => {
					productIds.push(item.id)
				});
				commit("setIds", productIds)
				break;
			default:
				commit("setIds", [])
		}
	},
	buttonClearSearchInput({ commit }) {
		commit("setSearchInput", '')
	},
}

const mutations = {
	setColstartblockproducts(state, colstartblockproducts) {
		state.colstartblockproducts = colstartblockproducts
	},
	setIds(state, ids) {
		state.ids = ids
	},
	setAddSaveTovarTrashMethodToggle(state, addSaveTovarTrashMethodToggle) {
		state.addSaveTovarTrashMethodToggle = addSaveTovarTrashMethodToggle;
	},
	setAddSaveTovarTrashMethodCol(state, addSaveTovarTrashMethodCol) {
		state.addSaveTovarTrashMethodCol = addSaveTovarTrashMethodCol;
	},
	setApiSrc(state, api_src) {
		state.api_src = api_src
	},
	setProducts(state, products) {
		state.products = products
	},
	setIsLoading(state, isLoading) {
		state.isLoading = isLoading
	},
	setPage(state, page) {
		state.page = page
	},
	setLoadTriggerElement(state, loadTriggerElement) {
		state.loadTriggerElement = loadTriggerElement
	},
	setIsMessage(state, isMessage) {
		state.isMessage = isMessage
	},
	setMessage(state, message) {
		state.message = message
	},
	setMethods(state, methods) {
		state.methods = methods
	},
	setIsActiveSearchHint(state, isActiveSearchHint) {
		state.isActiveSearchHint = isActiveSearchHint
	},
	setSaveTovarFavorites(state, saveTovarFavorites) {
		state.saveTovarFavorites = saveTovarFavorites
	},
	setSaveTovarHistories(state, saveTovarHistories) {
		state.saveTovarHistories = saveTovarHistories
	},
	setSaveTovarTrash(state, saveTovarTrash) {
		state.saveTovarTrash = saveTovarTrash
	},
	setCountTrashTovars(state, countTrashTovars) {
		state.countTrashTovars = countTrashTovars
	},
	setCountFavoriteTovars(state, countFavoriteTovars) {
		state.countFavoriteTovars = countFavoriteTovars
	},
}

export default {
	state, getters, actions, mutations
}