import router from '@/project/router';
import * as flsFunctions from "@/project/files/functions.js";
const state = {
	categories: [],
	category: [],
	searchHref: '',

	categoryId: null,

	maxPrice: '',
	minPrice: '',
	sort: 0,

	selectedSpecifications: [],

	isActiveMenuFilterPanel: false,
	isActiveMenu: false,
	isActiveMenuFillter: false,
	isActiveSubMenu: false,
	categoryTitle: '',

	localStorageSearch: 'search',
	saveDataSearch: [],

	searchInput: '',
}


const getters = {
	categories: (state) => state.categories,
	category: (state) => state.category,
	searchHref: (state) => state.searchHref,
	categoryId: (state) => state.categoryId,
	isActiveMenu: (state) => state.isActiveMenu,
	maxPrice: (state) => state.maxPrice,
	minPrice: (state) => state.minPrice,
	sort: (state) => state.sort,
	selectedSpecifications: (state) => state.selectedSpecifications,
	isActiveMenuFilterPanel: (state) => state.isActiveMenuFilterPanel,
	isActiveMenuFillter: (state) => state.isActiveMenuFillter,
	isActiveSubMenu: (state) => state.isActiveSubMenu,
	categoryTitle: (state) => state.categoryTitle,
	localStorageSearch: (state) => state.localStorageSearch,
	saveDataSearch: (state) => state.saveDataSearch,
	searchInput: (state) => state.searchInput,
}


const actions = {
	getSearchHref({ getters, commit, dispatch }, query) {
		if (query) {
			const queryParams = new URLSearchParams(query);
			const filteredParams = Object.entries(query)
											.filter(([key, value]) => key && value && key.toString().length > 0 && value.toString().length > 0 && key !== 'page')
											.map(([key, value]) => `${key}=${value}`)
											.join('&');

			const data = filteredParams ? `?${filteredParams}` : '';

			if (queryParams.has('q')) {
				commit("setSearchInput", queryParams.get('q').trim());
			}
			if (queryParams.has('category_id')) {
				commit("setCategoryId", queryParams.get('category_id'));
				if (getters.categoryTitle.length == 0) {
					dispatch("getCategory", queryParams.get('category_id'));
				}
			}
			if (queryParams.has('prices[from]')) {
				commit("setMaxPrice", queryParams.get('prices[from]'));
			}
			if (queryParams.has('prices[to]')) {
				commit("setMinPrice", queryParams.get('prices[to]'));
			}
			if (queryParams.has('sort')) {
				commit("setSort", queryParams.get('sort'));
			}
			if (queryParams.has('specifications')) {
				let selects = queryParams.getAll('specifications');
				let array = [];

				try {
					let parseResult = JSON.parse(selects);

					if (Array.isArray(parseResult)) {
						parseResult.forEach(item => {
							array.push(item);
						});
					}
				} catch (error) {
				}
				commit("setSelectedSpecifications", array);
			}
			commit("setSearchHref", data);
		}
	},
	zeroingHref({ getters, commit, dispatch }, { name, value }) {
		commit(name, value)
		commit("setCategoryTitle", '')
		commit("setMaxPrice", '')
		commit("setMinPrice", '')
		commit("setSort", 0);
		commit("setSelectedSpecifications", []);
	},
	sendSearch({ getters, commit, dispatch }) {
		const specificationsParam = getters.selectedSpecifications.length > 0
											? `[${getters.selectedSpecifications.join(',')}]`
											: '';
		const queryParams = {
			q: getters.searchInput,
			category_id: getters.categoryId,
			'prices[from]': getters.maxPrice,
			'prices[to]': getters.minPrice,
			sort: getters.sort,
			specifications: specificationsParam,
		};

		const filteredParams = {};
		for (const key in queryParams) {
			if (queryParams[key] !== null && queryParams[key] !== '') {
				filteredParams[key] = queryParams[key];
			}
		}
		dispatch("setSaveTovarSearch", getters.searchInput.trim());
		flsFunctions.bodyUnlock();
		commit("setIsActiveSearch", false);
		router.push({ name: 'search', query: filteredParams });
	},
	toggleMenu({ getters, commit, dispatch }) {
		commit("setIsActiveMenu", !getters.isActiveMenu)
	},
	initCountSaveTovars({ dispatch, getters }) {
		dispatch('scanLocalStorageFavorite');
		dispatch('scanLocalStorageTrash');
	},
	async getCategories({ getters, commit, dispatch }) {
		try {
			let response = await axios.get('/api/categories');
			if (response && response.data && response.data.length > 0) {
				commit("setCategories", response.data)
			} else {
				commit("setCategories", [])
			}
		} catch (error) {
			commit("setCategories", [])
		}
	},
	async getCategory({ getters, commit, dispatch }, id) {

		try {
			let response = await axios.get('/api/categories/' + id + '/name');
			if (response && response.data && response.data.length > 0) {
				commit("setCategory", response.data)
				let categoryTitle = []

				getters.category.forEach(item => {
					categoryTitle.push(item.name)
				});

				const titleString = categoryTitle.join(' / ');

				commit("setCategoryTitle", titleString)
			}
		} catch (error) {
		}
	},
	openCategories({ getters, commit, dispatch }, event) {
		if (!event.target.closest('.bkt-catygory-button__clear')) {
			commit("setIsActiveMenuFillter", true)
		}
	},
	setSaveTovarSearch({ getters, commit, dispatch }, data) {
		let dataSearch = getters.saveDataSearch;
		if (data.toString().length > 0) {
			if (dataSearch.length == 0) {
				let info = [data];
				localStorage.setItem(getters.localStorageSearch, JSON.stringify(info));
				commit("setSaveDataSearch", info)
			} else {
				let status = dataSearch.indexOf(data);
				if (status == -1) {
					dataSearch.unshift(data);
					localStorage.setItem(getters.localStorageSearch, JSON.stringify(dataSearch));
					commit("setSaveDataSearch", dataSearch);
				}
			}
		}
	},
	scanLocalStorageSearch({ getters, dispatch }) {
		if (!localStorage.getItem(getters.localStorageSearch)) {
			return false;
		}
		if (!Array.isArray(JSON.parse(localStorage.getItem(getters.localStorageSearch)))) {
			localStorage.removeItem(getters.localStorageSearch);
			return false;
		}
		let data = JSON.parse(localStorage.getItem(getters.localStorageSearch));

		data = data.filter((item) => typeof item == 'string');
		data.slice(0, 5);

		localStorage.setItem(getters.localStorageSearch, JSON.stringify(data));
		dispatch("getLocalStorageSearch")
	},
	getLocalStorageSearch({ commit, getters }) {
		let data = JSON.parse(localStorage.getItem(getters.localStorageSearch));

		if (data) {
			commit("setSaveDataSearch", data)
		}
	},
	closeCategories({ getters, commit, dispatch }) {
		commit("setIsActiveMenuFillter", false)
	},
	addClickCategory({ commit, getters, dispatch }, { id, event }) {
		dispatch("removeHiddenCategories");
		let currentElement = event.target;
		commit("setCategoryId", id)

		let title = [];

		for (let i = 0; i < 6; i++) {
			const hasDataMenu = currentElement.hasAttribute('data-category-menu');
			const category = currentElement.hasAttribute('data-category-link');
			const hasDataSubmenu = currentElement.hasAttribute('data-category-submenu');
			if (category) {
				currentElement.classList.add('_show')

				title.push(currentElement.innerText.trim());

				i = 0
			}

			if (hasDataSubmenu) {
				currentElement.querySelector("[data-category-button]").classList.add('_show')

				currentElement.querySelector("[data-category-button]").nextElementSibling.hidden = false

				title.push(currentElement.querySelector("[data-category-button]").innerText.trim());

				i = 0
			}
			if (hasDataMenu) {
				break;
			}
			currentElement = currentElement.parentElement;
		}

		const titleReversed = title.reverse()
		const titleString = titleReversed.join(' / ');

		commit("setCategoryTitle", titleString)
		dispatch("closeCategories")
	},
	removeHiddenCategories({ commit, getters, dispatch }) {
		const buttons = document.querySelectorAll('[data-category-button]._show');
		buttons.forEach(element => {
			element.classList.remove('_show');
			element.nextElementSibling.hidden = true
		});
		const links = document.querySelectorAll('[data-category-link]._show');
		links.forEach(element => {
			element.classList.remove('_show');
		});
	},
	clearCategoryTitle({ getters, commit, dispatch }) {
		commit("setCategoryTitle", '')
		dispatch("removeHiddenCategories");
		commit("setCategoryId", null);
	},
	addHintSearch({ commit, getters }, text) {
		let search_text = getters.searchInput + ' ' + text.trim()
		commit('setSearchInput', search_text.trim())
	},
	buttonClearHistories({ commit, getters }) {
		if (localStorage.getItem(getters.localStorageSearch)) {
			localStorage.removeItem(getters.localStorageSearch)
		}
		commit('setSaveDataSearch', [])
	},
}


const mutations = {
	setCategories(state, categories) {
		state.categories = categories;
	},
	setCategory(state, category) {
		state.category = category;
	},
	setSearchHref(state, searchHref) {
		state.searchHref = searchHref;
	},
	setCategoryId(state, categoryId) {
		state.categoryId = categoryId;
	},
	setMaxPrice(state, maxPrice) {
		state.maxPrice = maxPrice;
	},
	setMinPrice(state, minPrice) {
		state.minPrice = minPrice;
	},
	setSort(state, sort) {
		state.sort = sort;
	},
	setSelectedSpecifications(state, selectedSpecifications) {
		state.selectedSpecifications = selectedSpecifications;
	},
	setIsActiveMenuFilterPanel(state, isActiveMenuFilterPanel) {
		state.isActiveMenuFilterPanel = isActiveMenuFilterPanel;
	},
	setIsActiveMenu(state, isActiveMenu) {
		state.isActiveMenu = isActiveMenu;
	},
	setIsActiveMenuFillter(state, isActiveMenuFillter) {
		state.isActiveMenuFillter = isActiveMenuFillter;
	},
	setIsActiveSubMenu(state, isActiveSubMenu) {
		state.isActiveSubMenu = isActiveSubMenu;
	},
	setCategoryTitle(state, categoryTitle) {
		state.categoryTitle = categoryTitle;
	},
	setSaveDataSearch(state, saveDataSearch) {
		state.saveDataSearch = saveDataSearch;
	},
	setSearchInput(state, searchInput) {
		state.searchInput = searchInput;
	},
}


export default {
	state, getters, actions, mutations
}
