<template>
<aside :ref="`sidebar`" class="sidebar">
	<div class="sidebar__header">
		<button type="button" @click.prevent="menuInit" class="sidebar__icon sidebar__menu icon-menu button-hover-bgc">
			<svg viewBox="0 0 28 26" xmlns="http://www.w3.org/2000/svg">
				<path d="M0 4.875C0 3.97617 0.89375 3.25 2 3.25H26C27.1063 3.25 28 3.97617 28 4.875C28 5.77383 27.1063 6.5 26 6.5H2C0.89375 6.5 0 5.77383 0 4.875ZM0 13C0 12.1012 0.89375 11.375 2 11.375H26C27.1063 11.375 28 12.1012 28 13C28 13.8988 27.1063 14.625 26 14.625H2C0.89375 14.625 0 13.8988 0 13ZM28 21.125C28 22.0238 27.1063 22.75 26 22.75H2C0.89375 22.75 0 22.0238 0 21.125C0 20.2262 0.89375 19.5 2 19.5H26C27.1063 19.5 28 20.2262 28 21.125Z"/>
			</svg>
		</button>
		<router-link :to="{ name: 'users.login'}" class="sidebar__logo">
			AdminPanel
		</router-link>
	</div>
	<nav @click.prevent="menuHide" class="sidebar__body menu__body">
		<ul class="sidebar__content sidebar__lists menu__list">
			<!-----------------------------------  Setting  --Start--  ----------------------------------->
			<li class="sidebar__sublist sidebar-sublist">
				<button @click.self.prevent="clickMenuSublist($event)" type="button" class="sidebar-sublist__button sidebar-sublist-button a-hover-bgc">
					<div class="sidebar__btn sidebar-sublist-button__info">
						<span class="sidebar__icon sidebar-sublist-button__icon button-hover-bgc">
							<svg viewBox="0 0 349.667 349.667" xmlns="http://www.w3.org/2000/svg"><path d="M174.833 197.204c24.125 0 80.846-29.034 80.846-98.603C255.68 44.145 248.329 0 174.833 0c-73.495 0-80.846 44.145-80.846 98.602 0 69.568 56.721 98.602 80.846 98.602zM106.07 82.146c5.679-10.983 17.963-23.675 44.381-23.112 0 0 15.746 38.194 93.05 21.042.312 6.101.41 12.326.41 18.526 0 34.005-15.015 55.075-27.612 66.762-15.872 14.727-33.494 20.072-41.466 20.072-7.972 0-25.594-5.345-41.466-20.072-12.597-11.687-27.612-32.757-27.612-66.762.001-5.501.081-11.021.315-16.456z"/><path d="M324.926 298.327c-4.127-25.665-12.625-58.724-29.668-70.472-11.638-8.024-52.243-29.718-69.582-38.982l-.3-.16a5.666 5.666 0 00-6.17.541c-9.083 7.131-19.033 11.937-29.573 14.284a5.669 5.669 0 00-4.067 3.521l-10.733 28.291-10.733-28.291a5.669 5.669 0 00-4.067-3.521c-10.54-2.347-20.49-7.153-29.573-14.284a5.664 5.664 0 00-6.17-.541c-17.133 9.155-58.235 31.291-69.831 39.107-19.619 13.217-28.198 61.052-29.718 70.507a5.674 5.674 0 00.253 2.792c.702 1.982 18.708 48.548 149.839 48.548s149.137-46.566 149.839-48.548a5.664 5.664 0 00.254-2.792zM264.5 282.666l-25.667 8-25.667-8v-13.81H264.5v13.81z"/></svg>
						</span>
						<span class="sidebar__title sidebar-sublist-button__title">Профиль</span>
					</div>
					<div class="sidebar-sublist-button__button">
						<svg viewBox="0 0 10 11" xmlns="http://www.w3.org/2000/svg">
							<path d="M0.832683 3.00161C1.04591 3.00161 1.25924 3.06875 1.42175 3.20303L4.99935 6.15337L8.57747 3.20142C8.90299 2.93286 9.43034 2.93286 9.75586 3.20142C10.0814 3.46997 10.0814 3.90503 9.75586 4.17358L5.58919 7.61108C5.26367 7.87964 4.73633 7.87964 4.41081 7.61108L0.244141 4.17358C-0.0813799 3.90503 -0.0813799 3.46997 0.244141 3.20142C0.4056 3.06821 0.619141 3.00161 0.832683 3.00161Z"/>
						</svg>
					</div>
				</button>
				<div hidden class="sidebar-sublist__content">
					<ul class="sidebar__content sidebar-sublist__lists">
						<li class="sidebar__list sidebar-list a-hover-bgc">
							<router-link :to="{ name: 'settings.index'}" class="sidebar__btn sidebar-list__link">
								<span class="sidebar__icon sidebar-list__icon button-hover-bgc">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z"/></svg>
								</span>
								<span class="sidebar__title sidebar-list__title">Настройки</span>
							</router-link>
						</li>
						<li class="sidebar__list sidebar-list a-hover-bgc _exit">
							<a href class="sidebar__btn sidebar-list__link" @click.prevent="$parent.logout">
								<span class="sidebar__icon sidebar-list__icon button-hover-bgc">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
								</span>
								<span class="sidebar__title sidebar-list__title">Выйти</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<!-----------------------------------  Setting  --End--  ----------------------------------->

			<!-----------------------------------  App  --Start--  ----------------------------------->
			<li class="sidebar__sublist sidebar-sublist">
				<button @click.self.prevent="clickMenuSublist($event)" type="button" class="sidebar-sublist__button sidebar-sublist-button a-hover-bgc">
					<div class="sidebar__btn sidebar-sublist-button__info">
						<span class="sidebar__icon sidebar-sublist-button__icon button-hover-bgc">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M64 96c0-35.3 28.7-64 64-64H512c35.3 0 64 28.7 64 64V352H512V96H128V352H64V96zM0 403.2C0 392.6 8.6 384 19.2 384H620.8c10.6 0 19.2 8.6 19.2 19.2c0 42.4-34.4 76.8-76.8 76.8H76.8C34.4 480 0 445.6 0 403.2zM288 160c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v48h48c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H352v48c0 8.8-7.2 16-16 16H304c-8.8 0-16-7.2-16-16V272H240c-8.8 0-16-7.2-16-16V224c0-8.8 7.2-16 16-16h48V160z"/></svg>
						</span>
						<span class="sidebar__title sidebar-sublist-button__title">Приложение</span>
					</div>
					<div class="sidebar-sublist-button__button">
						<svg viewBox="0 0 10 11" xmlns="http://www.w3.org/2000/svg">
							<path d="M0.832683 3.00161C1.04591 3.00161 1.25924 3.06875 1.42175 3.20303L4.99935 6.15337L8.57747 3.20142C8.90299 2.93286 9.43034 2.93286 9.75586 3.20142C10.0814 3.46997 10.0814 3.90503 9.75586 4.17358L5.58919 7.61108C5.26367 7.87964 4.73633 7.87964 4.41081 7.61108L0.244141 4.17358C-0.0813799 3.90503 -0.0813799 3.46997 0.244141 3.20142C0.4056 3.06821 0.619141 3.00161 0.832683 3.00161Z"/>
						</svg>
					</div>
				</button>
				<div hidden class="sidebar-sublist__content">
					<ul class="sidebar__content sidebar-sublist__lists">
						<li class="sidebar__list sidebar-list a-hover-bgc">
							<router-link :to="{ name: 'app.index'}" class="sidebar__btn sidebar-list__link">
								<span class="sidebar__icon sidebar-list__icon button-hover-bgc">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V285.7l-86.8 86.8c-10.3 10.3-17.5 23.1-21 37.2l-18.7 74.9c-2.3 9.2-1.8 18.8 1.3 27.5H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128zM549.8 235.7l14.4 14.4c15.6 15.6 15.6 40.9 0 56.6l-29.4 29.4-71-71 29.4-29.4c15.6-15.6 40.9-15.6 56.6 0zM311.9 417L441.1 287.8l71 71L382.9 487.9c-4.1 4.1-9.2 7-14.9 8.4l-60.1 15c-5.5 1.4-11.2-.2-15.2-4.2s-5.6-9.7-4.2-15.2l15-60.1c1.4-5.6 4.3-10.8 8.4-14.9z"/></svg>
								</span>
								<span class="sidebar__title sidebar-list__title">Редактирование</span>
							</router-link>
						</li>
					</ul>
				</div>
			</li>
			<!-----------------------------------  App  --End--  ----------------------------------->

			<!-----------------------------------  Tovar  --Start--  ----------------------------------->
			<li class="sidebar__sublist sidebar-sublist">
				<button @click.self.prevent="clickMenuSublist($event)" type="button" class="sidebar-sublist__button sidebar-sublist-button a-hover-bgc">
					<div class="sidebar__btn sidebar-sublist-button__info">
						<span class="sidebar__icon sidebar-sublist-button__icon button-hover-bgc">
							<svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M160 0c-23.7 0-44.4 12.9-55.4 32H48C21.5 32 0 53.5 0 80v320c0 26.5 21.5 48 48 48h144V176c0-44.2 35.8-80 80-80h48V80c0-26.5-21.5-48-48-48h-56.6c-11-19.1-31.7-32-55.4-32zm112 128c-26.5 0-48 21.5-48 48v288c0 26.5 21.5 48 48 48h192c26.5 0 48-21.5 48-48V256h-96c-17.7 0-32-14.3-32-32v-96H272zM160 40a24 24 0 110 48 24 24 0 110-48zm256 88v96h96l-96-96z"/></svg>
						</span>
						<span class="sidebar__title sidebar-sublist-button__title">Товары</span>
					</div>
					<div class="sidebar-sublist-button__button">
						<svg viewBox="0 0 10 11" xmlns="http://www.w3.org/2000/svg">
							<path d="M0.832683 3.00161C1.04591 3.00161 1.25924 3.06875 1.42175 3.20303L4.99935 6.15337L8.57747 3.20142C8.90299 2.93286 9.43034 2.93286 9.75586 3.20142C10.0814 3.46997 10.0814 3.90503 9.75586 4.17358L5.58919 7.61108C5.26367 7.87964 4.73633 7.87964 4.41081 7.61108L0.244141 4.17358C-0.0813799 3.90503 -0.0813799 3.46997 0.244141 3.20142C0.4056 3.06821 0.619141 3.00161 0.832683 3.00161Z"/>
						</svg>
					</div>
				</button>
				<div hidden class="sidebar-sublist__content">
					<ul class="sidebar__content sidebar-sublist__lists">
						<li class="sidebar__list sidebar-list a-hover-bgc">
							<router-link :to="{ name: 'tovars.index'}" class="sidebar__btn sidebar-list__link">
								<span class="sidebar__icon sidebar-list__icon button-hover-bgc">
									<svg viewBox="0 0 349.667 349.667" xmlns="http://www.w3.org/2000/svg"><path d="M174.833 197.204c24.125 0 80.846-29.034 80.846-98.603C255.68 44.145 248.329 0 174.833 0c-73.495 0-80.846 44.145-80.846 98.602 0 69.568 56.721 98.602 80.846 98.602zM106.07 82.146c5.679-10.983 17.963-23.675 44.381-23.112 0 0 15.746 38.194 93.05 21.042.312 6.101.41 12.326.41 18.526 0 34.005-15.015 55.075-27.612 66.762-15.872 14.727-33.494 20.072-41.466 20.072-7.972 0-25.594-5.345-41.466-20.072-12.597-11.687-27.612-32.757-27.612-66.762.001-5.501.081-11.021.315-16.456z"/><path d="M324.926 298.327c-4.127-25.665-12.625-58.724-29.668-70.472-11.638-8.024-52.243-29.718-69.582-38.982l-.3-.16a5.666 5.666 0 00-6.17.541c-9.083 7.131-19.033 11.937-29.573 14.284a5.669 5.669 0 00-4.067 3.521l-10.733 28.291-10.733-28.291a5.669 5.669 0 00-4.067-3.521c-10.54-2.347-20.49-7.153-29.573-14.284a5.664 5.664 0 00-6.17-.541c-17.133 9.155-58.235 31.291-69.831 39.107-19.619 13.217-28.198 61.052-29.718 70.507a5.674 5.674 0 00.253 2.792c.702 1.982 18.708 48.548 149.839 48.548s149.137-46.566 149.839-48.548a5.664 5.664 0 00.254-2.792zM264.5 282.666l-25.667 8-25.667-8v-13.81H264.5v13.81z"/></svg>
								</span>
								<span class="sidebar__title sidebar-list__title">Все товары</span>
							</router-link>
						</li>
						<li class="sidebar__list sidebar-list a-hover-bgc">
							<router-link :to="{ name: 'tovars.create'}" class="sidebar__btn sidebar-list__link">
								<span class="sidebar__icon sidebar-list__icon button-hover-bgc">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z"/></svg>
								</span>
								<span class="sidebar__title sidebar-list__title">Добавить новые</span>
							</router-link>
						</li>
					</ul>
				</div>
			</li>
			<!-----------------------------------  Tovar  --End--  ----------------------------------->

			<!-----------------------------------  Commentary  --Start--  ----------------------------------->
			<li class="sidebar__sublist sidebar-sublist">
				<button @click.self.prevent="clickMenuSublist($event)" type="button" class="sidebar-sublist__button sidebar-sublist-button a-hover-bgc">
					<div class="sidebar__btn sidebar-sublist-button__info">
						<span class="sidebar__icon sidebar-sublist-button__icon button-hover-bgc">
							<svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M160 0c-23.7 0-44.4 12.9-55.4 32H48C21.5 32 0 53.5 0 80v320c0 26.5 21.5 48 48 48h144V176c0-44.2 35.8-80 80-80h48V80c0-26.5-21.5-48-48-48h-56.6c-11-19.1-31.7-32-55.4-32zm112 128c-26.5 0-48 21.5-48 48v288c0 26.5 21.5 48 48 48h192c26.5 0 48-21.5 48-48V256h-96c-17.7 0-32-14.3-32-32v-96H272zM160 40a24 24 0 110 48 24 24 0 110-48zm256 88v96h96l-96-96z"/></svg>
						</span>
						<span class="sidebar__title sidebar-sublist-button__title">Комментария</span>
					</div>
					<div class="sidebar-sublist-button__button">
						<svg viewBox="0 0 10 11" xmlns="http://www.w3.org/2000/svg">
							<path d="M0.832683 3.00161C1.04591 3.00161 1.25924 3.06875 1.42175 3.20303L4.99935 6.15337L8.57747 3.20142C8.90299 2.93286 9.43034 2.93286 9.75586 3.20142C10.0814 3.46997 10.0814 3.90503 9.75586 4.17358L5.58919 7.61108C5.26367 7.87964 4.73633 7.87964 4.41081 7.61108L0.244141 4.17358C-0.0813799 3.90503 -0.0813799 3.46997 0.244141 3.20142C0.4056 3.06821 0.619141 3.00161 0.832683 3.00161Z"/>
						</svg>
					</div>
				</button>
				<div hidden class="sidebar-sublist__content">
					<ul class="sidebar__content sidebar-sublist__lists">
						<li class="sidebar__list sidebar-list a-hover-bgc">
							<router-link :to="{ name: 'commentaries.index'}" class="sidebar__btn sidebar-list__link">
								<span class="sidebar__icon sidebar-list__icon button-hover-bgc">
									<svg viewBox="0 0 349.667 349.667" xmlns="http://www.w3.org/2000/svg"><path d="M174.833 197.204c24.125 0 80.846-29.034 80.846-98.603C255.68 44.145 248.329 0 174.833 0c-73.495 0-80.846 44.145-80.846 98.602 0 69.568 56.721 98.602 80.846 98.602zM106.07 82.146c5.679-10.983 17.963-23.675 44.381-23.112 0 0 15.746 38.194 93.05 21.042.312 6.101.41 12.326.41 18.526 0 34.005-15.015 55.075-27.612 66.762-15.872 14.727-33.494 20.072-41.466 20.072-7.972 0-25.594-5.345-41.466-20.072-12.597-11.687-27.612-32.757-27.612-66.762.001-5.501.081-11.021.315-16.456z"/><path d="M324.926 298.327c-4.127-25.665-12.625-58.724-29.668-70.472-11.638-8.024-52.243-29.718-69.582-38.982l-.3-.16a5.666 5.666 0 00-6.17.541c-9.083 7.131-19.033 11.937-29.573 14.284a5.669 5.669 0 00-4.067 3.521l-10.733 28.291-10.733-28.291a5.669 5.669 0 00-4.067-3.521c-10.54-2.347-20.49-7.153-29.573-14.284a5.664 5.664 0 00-6.17-.541c-17.133 9.155-58.235 31.291-69.831 39.107-19.619 13.217-28.198 61.052-29.718 70.507a5.674 5.674 0 00.253 2.792c.702 1.982 18.708 48.548 149.839 48.548s149.137-46.566 149.839-48.548a5.664 5.664 0 00.254-2.792zM264.5 282.666l-25.667 8-25.667-8v-13.81H264.5v13.81z"/></svg>
								</span>
								<span class="sidebar__title sidebar-list__title">Все комментарий</span>
							</router-link>
						</li>
					</ul>
				</div>
			</li>
			<!-----------------------------------  Commentary  --End--  ----------------------------------->

			<!-----------------------------------  Category  --Start--  ----------------------------------->
			<li class="sidebar__sublist sidebar-sublist">
				<button @click.self.prevent="clickMenuSublist($event)" type="button" class="sidebar-sublist__button sidebar-sublist-button a-hover-bgc">
					<div class="sidebar__btn sidebar-sublist-button__info">
						<span class="sidebar__icon sidebar-sublist-button__icon button-hover-bgc">
							<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M9.219 350.5C11.38 351.5 13.69 352 16 352c3.688 0 7.312-1.25 10.25-3.719l96-80C125.9 265.3 128 260.7 128 255.1S125.9 246.8 122.3 243.7l-96-80c-4.781-4-11.41-4.781-17.03-2.219C3.594 164.2 0 169.8 0 176v160C0 342.2 3.594 347.8 9.219 350.5zM32 96h384c17.67 0 32-14.33 32-32S433.7 32 416 32H32C14.33 32 0 46.33 0 63.1S14.33 96 32 96zM416 416H32c-17.67 0-32 14.33-32 31.1S14.33 480 32 480h384c17.67 0 32-14.33 32-32S433.7 416 416 416zM416 288h-192C206.3 288 192 302.3 192 319.1S206.3 352 224 352h192c17.67 0 32-14.33 32-32S433.7 288 416 288zM416 160h-192C206.3 160 192 174.3 192 191.1S206.3 224 224 224h192c17.67 0 32-14.33 32-32S433.7 160 416 160z"/></svg>
						</span>
						<span class="sidebar__title sidebar-sublist-button__title">Категория</span>
					</div>
					<div class="sidebar-sublist-button__button">
						<svg viewBox="0 0 10 11" xmlns="http://www.w3.org/2000/svg">
							<path d="M0.832683 3.00161C1.04591 3.00161 1.25924 3.06875 1.42175 3.20303L4.99935 6.15337L8.57747 3.20142C8.90299 2.93286 9.43034 2.93286 9.75586 3.20142C10.0814 3.46997 10.0814 3.90503 9.75586 4.17358L5.58919 7.61108C5.26367 7.87964 4.73633 7.87964 4.41081 7.61108L0.244141 4.17358C-0.0813799 3.90503 -0.0813799 3.46997 0.244141 3.20142C0.4056 3.06821 0.619141 3.00161 0.832683 3.00161Z"/>
						</svg>
					</div>
				</button>
				<div hidden class="sidebar-sublist__content">
					<ul class="sidebar__content sidebar-sublist__lists">
						<li class="sidebar__list sidebar-list a-hover-bgc">
							<router-link :to="{ name: 'categories.index'}" class="sidebar__btn sidebar-list__link">
								<span class="sidebar__icon sidebar-list__icon button-hover-bgc">
									<svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M80 48h-64C7.156 48 0 55.16 0 64v64c0 8.844 7.156 16 16 16h64C88.84 144 96 136.8 96 128V64C96 55.16 88.84 48 80 48zM80 208h-64C7.156 208 0 215.2 0 224v64c0 8.844 7.156 16 16 16h64C88.84 304 96 296.8 96 288V224C96 215.2 88.84 208 80 208zM80 368h-64C7.156 368 0 375.2 0 384v64c0 8.844 7.156 16 16 16h64C88.84 464 96 456.8 96 448v-64C96 375.2 88.84 368 80 368zM192 128h288c17.67 0 32-14.33 32-31.1S497.7 64 480 64H192C174.3 64 160 78.33 160 95.1S174.3 128 192 128zM480 384H192c-17.67 0-32 14.33-32 32s14.33 32 32 32h288c17.67 0 32-14.33 32-32S497.7 384 480 384zM480 224H192C174.3 224 160 238.3 160 256s14.33 32 32 32h288c17.67 0 32-14.33 32-32S497.7 224 480 224z"/></svg>
								</span>
								<span class="sidebar__title sidebar-list__title">Все категорий</span>
							</router-link>
						</li>
						<li class="sidebar__list sidebar-list a-hover-bgc">
							<router-link :to="{ name: 'categories.edit'}" class="sidebar__btn sidebar-list__link">
								<span class="sidebar__icon sidebar-list__icon button-hover-bgc">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M373.1 24.97C401.2-3.147 446.8-3.147 474.9 24.97L487 37.09C515.1 65.21 515.1 110.8 487 138.9L289.8 336.2C281.1 344.8 270.4 351.1 258.6 354.5L158.6 383.1C150.2 385.5 141.2 383.1 135 376.1C128.9 370.8 126.5 361.8 128.9 353.4L157.5 253.4C160.9 241.6 167.2 230.9 175.8 222.2L373.1 24.97zM440.1 58.91C431.6 49.54 416.4 49.54 407 58.91L377.9 88L424 134.1L453.1 104.1C462.5 95.6 462.5 80.4 453.1 71.03L440.1 58.91zM203.7 266.6L186.9 325.1L245.4 308.3C249.4 307.2 252.9 305.1 255.8 302.2L390.1 168L344 121.9L209.8 256.2C206.9 259.1 204.8 262.6 203.7 266.6zM200 64C213.3 64 224 74.75 224 88C224 101.3 213.3 112 200 112H88C65.91 112 48 129.9 48 152V424C48 446.1 65.91 464 88 464H360C382.1 464 400 446.1 400 424V312C400 298.7 410.7 288 424 288C437.3 288 448 298.7 448 312V424C448 472.6 408.6 512 360 512H88C39.4 512 0 472.6 0 424V152C0 103.4 39.4 64 88 64H200z"/></svg>
								</span>
								<span class="sidebar__title sidebar-list__title">Редактировать</span>
							</router-link>
						</li>
						<li class="sidebar__list sidebar-list a-hover-bgc">
							<router-link :to="{ name: 'categories.create'}" class="sidebar__btn sidebar-list__link">
								<span class="sidebar__icon sidebar-list__icon button-hover-bgc">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z"/></svg>
								</span>
								<span class="sidebar__title sidebar-list__title">Добавить новые</span>
							</router-link>
						</li>
					</ul>
				</div>
			</li>
			<!-----------------------------------  Category  --End--  ----------------------------------->

			<!-----------------------------------  Specification  --Start--  ----------------------------------->
			<li class="sidebar__sublist sidebar-sublist">
				<button @click.self.prevent="clickMenuSublist($event)" type="button" class="sidebar-sublist__button sidebar-sublist-button a-hover-bgc">
					<div class="sidebar__btn sidebar-sublist-button__info">
						<span class="sidebar__icon sidebar-sublist-button__icon button-hover-bgc">
							<svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M0 416c0 17.7 14.3 32 32 32h54.7c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H233.3c-12.3-28.3-40.5-48-73.3-48s-61 19.7-73.3 48H32c-17.7 0-32 14.3-32 32zm128 0a32 32 0 1164 0 32 32 0 11-64 0zm192-160a32 32 0 1164 0 32 32 0 11-64 0zm32-80c-32.8 0-61 19.7-73.3 48H32c-17.7 0-32 14.3-32 32s14.3 32 32 32h246.7c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48H480c17.7 0 32-14.3 32-32s-14.3-32-32-32h-54.7c-12.3-28.3-40.5-48-73.3-48zm-160-48a32 32 0 110-64 32 32 0 110 64zm73.3-64C253 35.7 224.8 16 192 16s-61 19.7-73.3 48H32C14.3 64 0 78.3 0 96s14.3 32 32 32h86.7c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H265.3z"/></svg>
						</span>
						<span class="sidebar__title sidebar-sublist-button__title">Характеристики</span>
					</div>
					<div class="sidebar-sublist-button__button">
						<svg viewBox="0 0 10 11" xmlns="http://www.w3.org/2000/svg">
							<path d="M0.832683 3.00161C1.04591 3.00161 1.25924 3.06875 1.42175 3.20303L4.99935 6.15337L8.57747 3.20142C8.90299 2.93286 9.43034 2.93286 9.75586 3.20142C10.0814 3.46997 10.0814 3.90503 9.75586 4.17358L5.58919 7.61108C5.26367 7.87964 4.73633 7.87964 4.41081 7.61108L0.244141 4.17358C-0.0813799 3.90503 -0.0813799 3.46997 0.244141 3.20142C0.4056 3.06821 0.619141 3.00161 0.832683 3.00161Z"/>
						</svg>
					</div>
				</button>
				<div hidden class="sidebar-sublist__content">
					<ul class="sidebar__content sidebar-sublist__lists">
						<li class="sidebar__list sidebar-list a-hover-bgc">
							<router-link :to="{ name: 'specifications.index'}" class="sidebar__btn sidebar-list__link">
								<span class="sidebar__icon sidebar-list__icon button-hover-bgc">
									<svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M80 48h-64C7.156 48 0 55.16 0 64v64c0 8.844 7.156 16 16 16h64C88.84 144 96 136.8 96 128V64C96 55.16 88.84 48 80 48zM80 208h-64C7.156 208 0 215.2 0 224v64c0 8.844 7.156 16 16 16h64C88.84 304 96 296.8 96 288V224C96 215.2 88.84 208 80 208zM80 368h-64C7.156 368 0 375.2 0 384v64c0 8.844 7.156 16 16 16h64C88.84 464 96 456.8 96 448v-64C96 375.2 88.84 368 80 368zM192 128h288c17.67 0 32-14.33 32-31.1S497.7 64 480 64H192C174.3 64 160 78.33 160 95.1S174.3 128 192 128zM480 384H192c-17.67 0-32 14.33-32 32s14.33 32 32 32h288c17.67 0 32-14.33 32-32S497.7 384 480 384zM480 224H192C174.3 224 160 238.3 160 256s14.33 32 32 32h288c17.67 0 32-14.33 32-32S497.7 224 480 224z"/></svg>
								</span>
								<span class="sidebar__title sidebar-list__title">Все характеристики</span>
							</router-link>
						</li>
						<li class="sidebar__list sidebar-list a-hover-bgc">
							<router-link :to="{ name: 'specifications.edit'}" class="sidebar__btn sidebar-list__link">
								<span class="sidebar__icon sidebar-list__icon button-hover-bgc">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M373.1 24.97C401.2-3.147 446.8-3.147 474.9 24.97L487 37.09C515.1 65.21 515.1 110.8 487 138.9L289.8 336.2C281.1 344.8 270.4 351.1 258.6 354.5L158.6 383.1C150.2 385.5 141.2 383.1 135 376.1C128.9 370.8 126.5 361.8 128.9 353.4L157.5 253.4C160.9 241.6 167.2 230.9 175.8 222.2L373.1 24.97zM440.1 58.91C431.6 49.54 416.4 49.54 407 58.91L377.9 88L424 134.1L453.1 104.1C462.5 95.6 462.5 80.4 453.1 71.03L440.1 58.91zM203.7 266.6L186.9 325.1L245.4 308.3C249.4 307.2 252.9 305.1 255.8 302.2L390.1 168L344 121.9L209.8 256.2C206.9 259.1 204.8 262.6 203.7 266.6zM200 64C213.3 64 224 74.75 224 88C224 101.3 213.3 112 200 112H88C65.91 112 48 129.9 48 152V424C48 446.1 65.91 464 88 464H360C382.1 464 400 446.1 400 424V312C400 298.7 410.7 288 424 288C437.3 288 448 298.7 448 312V424C448 472.6 408.6 512 360 512H88C39.4 512 0 472.6 0 424V152C0 103.4 39.4 64 88 64H200z"/></svg>
								</span>
								<span class="sidebar__title sidebar-list__title">Редактировать</span>
							</router-link>
						</li>
						<li class="sidebar__list sidebar-list a-hover-bgc">
							<router-link :to="{ name: 'specifications.create'}" class="sidebar__btn sidebar-list__link">
								<span class="sidebar__icon sidebar-list__icon button-hover-bgc">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z"/></svg>
								</span>
								<span class="sidebar__title sidebar-list__title">Добавить новые</span>
							</router-link>
						</li>
					</ul>
				</div>
			</li>
			<!-----------------------------------  Specification  --End--  ----------------------------------->

			<!-----------------------------------  Specification  --Start--  ----------------------------------->
			<li class="sidebar__sublist sidebar-sublist">
				<button @click.self.prevent="clickMenuSublist($event)" type="button" class="sidebar-sublist__button sidebar-sublist-button a-hover-bgc">
					<div class="sidebar__btn sidebar-sublist-button__info">
						<span class="sidebar__icon sidebar-sublist-button__icon button-hover-bgc">
							<svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M0 416c0 17.7 14.3 32 32 32h54.7c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H233.3c-12.3-28.3-40.5-48-73.3-48s-61 19.7-73.3 48H32c-17.7 0-32 14.3-32 32zm128 0a32 32 0 1164 0 32 32 0 11-64 0zm192-160a32 32 0 1164 0 32 32 0 11-64 0zm32-80c-32.8 0-61 19.7-73.3 48H32c-17.7 0-32 14.3-32 32s14.3 32 32 32h246.7c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48H480c17.7 0 32-14.3 32-32s-14.3-32-32-32h-54.7c-12.3-28.3-40.5-48-73.3-48zm-160-48a32 32 0 110-64 32 32 0 110 64zm73.3-64C253 35.7 224.8 16 192 16s-61 19.7-73.3 48H32C14.3 64 0 78.3 0 96s14.3 32 32 32h86.7c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H265.3z"/></svg>
						</span>
						<span class="sidebar__title sidebar-sublist-button__title">Свзять категорий с характеристикой</span>
					</div>
					<div class="sidebar-sublist-button__button">
						<svg viewBox="0 0 10 11" xmlns="http://www.w3.org/2000/svg">
							<path d="M0.832683 3.00161C1.04591 3.00161 1.25924 3.06875 1.42175 3.20303L4.99935 6.15337L8.57747 3.20142C8.90299 2.93286 9.43034 2.93286 9.75586 3.20142C10.0814 3.46997 10.0814 3.90503 9.75586 4.17358L5.58919 7.61108C5.26367 7.87964 4.73633 7.87964 4.41081 7.61108L0.244141 4.17358C-0.0813799 3.90503 -0.0813799 3.46997 0.244141 3.20142C0.4056 3.06821 0.619141 3.00161 0.832683 3.00161Z"/>
						</svg>
					</div>
				</button>
				<div hidden class="sidebar-sublist__content">
					<ul class="sidebar__content sidebar-sublist__lists">
						<li class="sidebar__list sidebar-list a-hover-bgc">
							<router-link :to="{ name: 'categoryspecifications.index'}" class="sidebar__btn sidebar-list__link">
								<span class="sidebar__icon sidebar-list__icon button-hover-bgc">
									<svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M80 48h-64C7.156 48 0 55.16 0 64v64c0 8.844 7.156 16 16 16h64C88.84 144 96 136.8 96 128V64C96 55.16 88.84 48 80 48zM80 208h-64C7.156 208 0 215.2 0 224v64c0 8.844 7.156 16 16 16h64C88.84 304 96 296.8 96 288V224C96 215.2 88.84 208 80 208zM80 368h-64C7.156 368 0 375.2 0 384v64c0 8.844 7.156 16 16 16h64C88.84 464 96 456.8 96 448v-64C96 375.2 88.84 368 80 368zM192 128h288c17.67 0 32-14.33 32-31.1S497.7 64 480 64H192C174.3 64 160 78.33 160 95.1S174.3 128 192 128zM480 384H192c-17.67 0-32 14.33-32 32s14.33 32 32 32h288c17.67 0 32-14.33 32-32S497.7 384 480 384zM480 224H192C174.3 224 160 238.3 160 256s14.33 32 32 32h288c17.67 0 32-14.33 32-32S497.7 224 480 224z"/></svg>
								</span>
								<span class="sidebar__title sidebar-list__title">Все связи с категорием</span>
							</router-link>
						</li>
						<li class="sidebar__list sidebar-list a-hover-bgc">
							<router-link :to="{ name: 'categoryspecifications.edit'}" class="sidebar__btn sidebar-list__link">
								<span class="sidebar__icon sidebar-list__icon button-hover-bgc">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M373.1 24.97C401.2-3.147 446.8-3.147 474.9 24.97L487 37.09C515.1 65.21 515.1 110.8 487 138.9L289.8 336.2C281.1 344.8 270.4 351.1 258.6 354.5L158.6 383.1C150.2 385.5 141.2 383.1 135 376.1C128.9 370.8 126.5 361.8 128.9 353.4L157.5 253.4C160.9 241.6 167.2 230.9 175.8 222.2L373.1 24.97zM440.1 58.91C431.6 49.54 416.4 49.54 407 58.91L377.9 88L424 134.1L453.1 104.1C462.5 95.6 462.5 80.4 453.1 71.03L440.1 58.91zM203.7 266.6L186.9 325.1L245.4 308.3C249.4 307.2 252.9 305.1 255.8 302.2L390.1 168L344 121.9L209.8 256.2C206.9 259.1 204.8 262.6 203.7 266.6zM200 64C213.3 64 224 74.75 224 88C224 101.3 213.3 112 200 112H88C65.91 112 48 129.9 48 152V424C48 446.1 65.91 464 88 464H360C382.1 464 400 446.1 400 424V312C400 298.7 410.7 288 424 288C437.3 288 448 298.7 448 312V424C448 472.6 408.6 512 360 512H88C39.4 512 0 472.6 0 424V152C0 103.4 39.4 64 88 64H200z"/></svg>
								</span>
								<span class="sidebar__title sidebar-list__title">Изменить свзязь с категорием</span>
							</router-link>
						</li>
						<li class="sidebar__list sidebar-list a-hover-bgc">
							<router-link :to="{ name: 'categoryspecifications.create'}" class="sidebar__btn sidebar-list__link">
								<span class="sidebar__icon sidebar-list__icon button-hover-bgc">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z"/></svg>
								</span>
								<span class="sidebar__title sidebar-list__title">Создать связать с категорием</span>
							</router-link>
						</li>
					</ul>
				</div>
			</li>
			<!-----------------------------------  Specification  --End--  ----------------------------------->

			<!-----------------------------------  Tag  --Start--  ----------------------------------->
			<li class="sidebar__sublist sidebar-sublist">
				<button @click.self.prevent="clickMenuSublist($event)" type="button" class="sidebar-sublist__button sidebar-sublist-button a-hover-bgc">
					<div class="sidebar__btn sidebar-sublist-button__info">
						<span class="sidebar__icon sidebar-sublist-button__icon button-hover-bgc">
							<svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc.--><path d="M345 39.1l127.8 129.3c52.4 53 52.4 138.2 0 191.2l-112 113.3c-9.3 9.4-24.5 9.5-33.9.2s-9.5-24.5-.2-33.9l111.9-113.3c33.9-34.3 33.9-89.4 0-123.7L310.9 72.9c-9.3-9.4-9.2-24.6.2-33.9s24.6-9.2 33.9.2zM0 229.5V80c0-26.5 21.5-48 48-48h149.5c17 0 33.3 6.7 45.3 18.7l168 168c25 25 25 65.5 0 90.5L277.3 442.7c-25 25-65.5 25-90.5 0l-168-168C6.7 262.7 0 246.5 0 229.5zM144 144a32 32 0 10-64 0 32 32 0 1064 0z"/></svg>
						</span>
						<span class="sidebar__title sidebar-sublist-button__title">Теги</span>
					</div>
					<div class="sidebar-sublist-button__button">
						<svg viewBox="0 0 10 11" xmlns="http://www.w3.org/2000/svg">
							<path d="M0.832683 3.00161C1.04591 3.00161 1.25924 3.06875 1.42175 3.20303L4.99935 6.15337L8.57747 3.20142C8.90299 2.93286 9.43034 2.93286 9.75586 3.20142C10.0814 3.46997 10.0814 3.90503 9.75586 4.17358L5.58919 7.61108C5.26367 7.87964 4.73633 7.87964 4.41081 7.61108L0.244141 4.17358C-0.0813799 3.90503 -0.0813799 3.46997 0.244141 3.20142C0.4056 3.06821 0.619141 3.00161 0.832683 3.00161Z"/>
						</svg>
					</div>
				</button>
				<div hidden class="sidebar-sublist__content">
					<ul class="sidebar__content sidebar-sublist__lists">
						<li class="sidebar__list sidebar-list a-hover-bgc">
							<router-link :to="{ name: 'tags.index'}" class="sidebar__btn sidebar-list__link">
								<span class="sidebar__icon sidebar-list__icon button-hover-bgc">
									<svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M80 48h-64C7.156 48 0 55.16 0 64v64c0 8.844 7.156 16 16 16h64C88.84 144 96 136.8 96 128V64C96 55.16 88.84 48 80 48zM80 208h-64C7.156 208 0 215.2 0 224v64c0 8.844 7.156 16 16 16h64C88.84 304 96 296.8 96 288V224C96 215.2 88.84 208 80 208zM80 368h-64C7.156 368 0 375.2 0 384v64c0 8.844 7.156 16 16 16h64C88.84 464 96 456.8 96 448v-64C96 375.2 88.84 368 80 368zM192 128h288c17.67 0 32-14.33 32-31.1S497.7 64 480 64H192C174.3 64 160 78.33 160 95.1S174.3 128 192 128zM480 384H192c-17.67 0-32 14.33-32 32s14.33 32 32 32h288c17.67 0 32-14.33 32-32S497.7 384 480 384zM480 224H192C174.3 224 160 238.3 160 256s14.33 32 32 32h288c17.67 0 32-14.33 32-32S497.7 224 480 224z"/></svg>
								</span>
								<span class="sidebar__title sidebar-list__title">Все теги</span>
							</router-link>
						</li>
						<li class="sidebar__list sidebar-list a-hover-bgc">
							<router-link :to="{ name: 'tags.edit'}" class="sidebar__btn sidebar-list__link">
								<span class="sidebar__icon sidebar-list__icon button-hover-bgc">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M373.1 24.97C401.2-3.147 446.8-3.147 474.9 24.97L487 37.09C515.1 65.21 515.1 110.8 487 138.9L289.8 336.2C281.1 344.8 270.4 351.1 258.6 354.5L158.6 383.1C150.2 385.5 141.2 383.1 135 376.1C128.9 370.8 126.5 361.8 128.9 353.4L157.5 253.4C160.9 241.6 167.2 230.9 175.8 222.2L373.1 24.97zM440.1 58.91C431.6 49.54 416.4 49.54 407 58.91L377.9 88L424 134.1L453.1 104.1C462.5 95.6 462.5 80.4 453.1 71.03L440.1 58.91zM203.7 266.6L186.9 325.1L245.4 308.3C249.4 307.2 252.9 305.1 255.8 302.2L390.1 168L344 121.9L209.8 256.2C206.9 259.1 204.8 262.6 203.7 266.6zM200 64C213.3 64 224 74.75 224 88C224 101.3 213.3 112 200 112H88C65.91 112 48 129.9 48 152V424C48 446.1 65.91 464 88 464H360C382.1 464 400 446.1 400 424V312C400 298.7 410.7 288 424 288C437.3 288 448 298.7 448 312V424C448 472.6 408.6 512 360 512H88C39.4 512 0 472.6 0 424V152C0 103.4 39.4 64 88 64H200z"/></svg>
								</span>
								<span class="sidebar__title sidebar-list__title">Редактировать</span>
							</router-link>
						</li>
						<li class="sidebar__list sidebar-list a-hover-bgc">
							<router-link :to="{ name: 'tags.create'}" class="sidebar__btn sidebar-list__link">
								<span class="sidebar__icon sidebar-list__icon button-hover-bgc">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z"/></svg>
								</span>
								<span class="sidebar__title sidebar-list__title">Добавить новые</span>
							</router-link>
						</li>
					</ul>
				</div>
			</li>
			<!-----------------------------------  Tag  --End--  ----------------------------------->

			<!-----------------------------------  SearchHint  --Start--  ----------------------------------->
			<li class="sidebar__sublist sidebar-sublist">
				<button @click.self.prevent="clickMenuSublist($event)" type="button" class="sidebar-sublist__button sidebar-sublist-button a-hover-bgc">
					<div class="sidebar__btn sidebar-sublist-button__info">
						<span class="sidebar__icon sidebar-sublist-button__icon button-hover-bgc">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352c79.5 0 144-64.5 144-144s-64.5-144-144-144S64 128.5 64 208s64.5 144 144 144z"/></svg>
						</span>
						<span class="sidebar__title sidebar-sublist-button__title">Рекомендаций в поиске</span>
					</div>
					<div class="sidebar-sublist-button__button">
						<svg viewBox="0 0 10 11" xmlns="http://www.w3.org/2000/svg">
							<path d="M0.832683 3.00161C1.04591 3.00161 1.25924 3.06875 1.42175 3.20303L4.99935 6.15337L8.57747 3.20142C8.90299 2.93286 9.43034 2.93286 9.75586 3.20142C10.0814 3.46997 10.0814 3.90503 9.75586 4.17358L5.58919 7.61108C5.26367 7.87964 4.73633 7.87964 4.41081 7.61108L0.244141 4.17358C-0.0813799 3.90503 -0.0813799 3.46997 0.244141 3.20142C0.4056 3.06821 0.619141 3.00161 0.832683 3.00161Z"/>
						</svg>
					</div>
				</button>
				<div hidden class="sidebar-sublist__content">
					<ul class="sidebar__content sidebar-sublist__lists">
						<li class="sidebar__list sidebar-list a-hover-bgc">
							<router-link :to="{ name: 'searchhints.index'}" class="sidebar__btn sidebar-list__link">
								<span class="sidebar__icon sidebar-list__icon button-hover-bgc">
									<svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M80 48h-64C7.156 48 0 55.16 0 64v64c0 8.844 7.156 16 16 16h64C88.84 144 96 136.8 96 128V64C96 55.16 88.84 48 80 48zM80 208h-64C7.156 208 0 215.2 0 224v64c0 8.844 7.156 16 16 16h64C88.84 304 96 296.8 96 288V224C96 215.2 88.84 208 80 208zM80 368h-64C7.156 368 0 375.2 0 384v64c0 8.844 7.156 16 16 16h64C88.84 464 96 456.8 96 448v-64C96 375.2 88.84 368 80 368zM192 128h288c17.67 0 32-14.33 32-31.1S497.7 64 480 64H192C174.3 64 160 78.33 160 95.1S174.3 128 192 128zM480 384H192c-17.67 0-32 14.33-32 32s14.33 32 32 32h288c17.67 0 32-14.33 32-32S497.7 384 480 384zM480 224H192C174.3 224 160 238.3 160 256s14.33 32 32 32h288c17.67 0 32-14.33 32-32S497.7 224 480 224z"/></svg>
								</span>
								<span class="sidebar__title sidebar-list__title">Все рекомендаций</span>
							</router-link>
						</li>
						<li class="sidebar__list sidebar-list a-hover-bgc">
							<router-link :to="{ name: 'searchhints.edit'}" class="sidebar__btn sidebar-list__link">
								<span class="sidebar__icon sidebar-list__icon button-hover-bgc">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M373.1 24.97C401.2-3.147 446.8-3.147 474.9 24.97L487 37.09C515.1 65.21 515.1 110.8 487 138.9L289.8 336.2C281.1 344.8 270.4 351.1 258.6 354.5L158.6 383.1C150.2 385.5 141.2 383.1 135 376.1C128.9 370.8 126.5 361.8 128.9 353.4L157.5 253.4C160.9 241.6 167.2 230.9 175.8 222.2L373.1 24.97zM440.1 58.91C431.6 49.54 416.4 49.54 407 58.91L377.9 88L424 134.1L453.1 104.1C462.5 95.6 462.5 80.4 453.1 71.03L440.1 58.91zM203.7 266.6L186.9 325.1L245.4 308.3C249.4 307.2 252.9 305.1 255.8 302.2L390.1 168L344 121.9L209.8 256.2C206.9 259.1 204.8 262.6 203.7 266.6zM200 64C213.3 64 224 74.75 224 88C224 101.3 213.3 112 200 112H88C65.91 112 48 129.9 48 152V424C48 446.1 65.91 464 88 464H360C382.1 464 400 446.1 400 424V312C400 298.7 410.7 288 424 288C437.3 288 448 298.7 448 312V424C448 472.6 408.6 512 360 512H88C39.4 512 0 472.6 0 424V152C0 103.4 39.4 64 88 64H200z"/></svg>
								</span>
								<span class="sidebar__title sidebar-list__title">Редактировать</span>
							</router-link>
						</li>
						<li class="sidebar__list sidebar-list a-hover-bgc">
							<router-link :to="{ name: 'searchhints.create'}" class="sidebar__btn sidebar-list__link">
								<span class="sidebar__icon sidebar-list__icon button-hover-bgc">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z"/></svg>
								</span>
								<span class="sidebar__title sidebar-list__title">Добавить новые</span>
							</router-link>
						</li>
					</ul>
				</div>
			</li>
			<!-----------------------------------  SearchHint  --End--  ----------------------------------->
		</ul>
	</nav>
</aside>
</template>

<script>
	import * as flsFunctions from "./../../files/functions.js";
    export default {
		name: 'SidebarComponent',
		data(){
			return {
			}
		},
		mounted(){
		},
		methods: {
			menuInit() {
				flsFunctions.bodyLockToggle();
				document.documentElement.classList.toggle("menu-open");
				if (flsFunctions.emSreenWidth(991.98)) {
					const elementsWithActive = this.$refs['sidebar'].querySelectorAll('.sidebar-sublist__button._active');
					elementsWithActive.forEach(element => {
						flsFunctions._slideUp(element.nextElementSibling);
						element.classList.remove('_active');
					});
				}

			},
			menuHide(e) {
				if (document.documentElement.classList.contains('menu-open') && (e.target.closest(".sidebar-list__link") || !e.target.closest(".menu__list"))) {
					flsFunctions.bodyUnlock();
					document.documentElement.classList.remove("menu-open");
				}
			},
			clickMenuSublist(event) {
				let button = event.target;
				if (flsFunctions.emSreenWidth(991.98) && document.documentElement.classList.contains("menu-open")) {
					flsFunctions.menuClose(event)
				}
				if (!button.nextElementSibling.classList.contains("_slide")) {
					flsFunctions._slideToggle(button.nextElementSibling);
					button.classList.toggle('_active');
				}
			},
		}
    }
</script>

<style scoped>
</style>