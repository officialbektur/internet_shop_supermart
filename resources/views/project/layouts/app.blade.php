<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="format-detection" content="telephone=no">
	<!--------------------  Meta Viewport Adaptation for a mobile device  -------------------->
	<meta name="viewport" id="metaViewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!--------------------  Top Panel Color --Start--  -------------------->
	<!-------------------- Chrome, Firefox OS and Opera -------------------->
	<meta name="theme-color" content="#F0F8FF" />
	<!--------------------  Windows Phone -------------------->
	<meta name="msapplication-navbutton-color" content="#F0F8FF" />
	<!--------------------  iOS Safari ----->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black-transcluent" />
	<!-------------------- Top Panel Color --End--  -------------------->
	<!--------------------  SHORTCUT ICON  -------------------->
	<link rel="shortcut icon" href="{{ asset('storage/project/shortcuticons/icon.png') }}" type="image/x-icon" />
	<!--------------------  TITLE  -------------------->
	<title>SuperMart</title>
	<!-------------------- DESCRIPTION OF THE SITE -------------------->
	<meta name="description" content="internet shop" />
	<!--------------------  Don't forget "On" indexing  -------------------->
	<meta name="robots" content="noindex, nofollow" />
	<!-------------------- The author of the site -------------------->
	<meta name="author" content="Akylbek u Bektur" />
	<!--------------------  Additional connection  --Start--  -------------------->
	<!--------------------  CSS  -------------------->
	@vite(['resources/sass/project/app.scss', 'resources/js/project/app.js'])
	<!--------------------  Additional connection  --End--  -------------------->
</head>
<body>
	<!---------------------------------------------  Wrapper  --Start--  --------------------------------------------->
	<div class="wrapper" id="app">
		@yield('content')
	</div>
	<!---------------------------------------------  Wrapper  --End--  --------------------------------------------->
	@include("project.includes.blocks.scroll-up-button")
	<!-----------------------------------  Script  --Start-- ----------------------------------->
	<!--------------------  No Script  -------------------->
	<noscript>
		<div class="noscript__content">
			<div class="noscript__text">
				Для Полной функциональности этого Сайта необходимо Включить JavaScript. Вот
				<a href="https://geekhacker.ru/kak-vklyuchit-javascript-v-brauzere/#i-2">
					Инструкции, Как Включить JavaScript в Вашем Браузере.
				</a>
			</div>
			<div class="noscript__text">
				JavaScript must be Enabled for Full Functionality of this Site. Here are
				<a href="https://yandex.com/support/common/browsers-settings/browsers-java-js-settings.html">
					Instructions on How to Enable JavaScript in Your Browser.
				</a>
			</div>
		</div>
	</noscript>
	<!--------------------  No Script  -------------------->
	<!-----------------------------------  Script  --End-- ----------------------------------->
</body>
</html>