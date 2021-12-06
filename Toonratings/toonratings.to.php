<link rel="icon" href="/soundabox.png"></link>
<html lang="en">
<?php
	session_start(); 
	include_once 'dbh.inc.php';
	include_once 'userLogin.php';

?>
<link href="all.min.css" rel="stylesheet">
<link rel="canonical" href="https://toonratings.com/">
<style>



	body{
		//zoom: 85%;
		font-size: 100%;
		margin: 0;
		font-family: Arial, Helvetica, sans-serif;
	}
	table{
		width:100%;
	}
	p:empty::before {
	  content: attr(data-placeholder);
	  cursor: text;
	  color:gray;
	}
	#opinionTable
	{
		margin: 20px 0px 20px 40px;
		padding:60px;
	}
	.note{
		white-space: pre-wrap;
		font-size:20px;
		color: gray;
		padding: 30px;
		border: 1px solid #ccc;
		margin;30px;
	}
	.chart{
		height: 370px; 
		width: 100%;
	}
	.banner{
		padding: 5px;
		margin: 5px;
		color: white;
		font-size:60px;
		text-align: center;
		border-radius: 25px;
		font-weight: 900;
		background-color: #1fd06f;
	}
	.bannerIcon{
		height:80px;
	}
	.message{
		width: 100%;
		margin: 5px;
	}
	.moreinfo{
		font-size:13px;
		float:right;
	}
	.toolbar input[type=text] 
	{
		border: 1px solid #ccc;
	}
	.toolbar {
		top: 0;
		height:80px;
		position: -webkit-sticky; /* Safari */
		position: fixed;
		width:100%;
		background-color: #e9e9e9;
		display: flex;
		align-items: center;

		justify-content: space-between;
	   -moz-box-shadow: 0 8px 6px -6px black;
	    box-shadow: 0 8px 6px -6px black;
		z-index: 4;
	}
	.toolbar .search-container {
			text-align:center;
		}
	.toolbar #searchThis{
		float:left;
		border-radius: 25px 0px 0px 25px ;
		vertical-align: middle;
		margin-right: 1px;
		background: #ddd;
		height: 25px;
		width: 100px;
		font-size: 14px;
		border: none;
		cursor: pointer;
		}
	.toolbar #searchBox{
		float:left;
	}
	.extended{
		top: 80px;
	}
	.extended div{
		margin:auto;
	}
	.unextended{
		display:none;
	}
	#searchWhat{
		padding: 4px;
		font-size: 25px;
		border: none;
		width: 500px;
		border-radius: 25px 25px 25px 25px ;
	}
	#rightUnderSearchBar{
		position: absolute;
		width: 400px;
		height:auto;
		padding: 10px;
	}
	.autofillWords, .searchResults {
		position: relative;
		width: 400px;
		padding: 10px;
		cursor: pointer;
		background-color: white; 
		border-bottom: 1px solid  #e9e9e9; 
		display: flex;
		align-items: center;
		z-index:3;
	}
	.autofillWords:hover {
	  background-color: #e9e9e9; 
	}

	.previewCover{
		height: 45px; 
		width: 45px;
		padding: 5px;
	}
	.search{
		text-decoration:none;
		color: gray;
	}
	.searchAuthor{
		font-size: 12px;
	}
	.searchScore{
		margin-left: auto;
	}
	.searchDetail{
		text-align: left;
		white-space: pre-wrap;
	}
	.autocomplete-active {
	  background-color: green !important; 
	  color: #ffffff; 
	}
	.home{
		margin: 5px;
		padding: 5px;
		color:white;
		text-decoration:none;
		font-size:25px;
	}
	.homeButton{
		height:60px;
		width:auto;
		padding:5px;
	}
	#content{
		align-items: center;
		display: block;
		padding: 0px;
		margin: 200px auto 200px auto;
		max-width: 1200px;
	}
	#contact{
		display: block;
		padding: 5px;
		margin: 0px auto 0px auto;
		text-align: center;
		background-color: black;
		color: white;
		min-width: 600px;
		max-width: 1200px;
	}
	.rankings{
		margin: auto;
	}
	.wrapper{
		margin: 20px;
		padding: 20px;
		position: relative;
		width: 30%;
		height: 20%;
		min-width: 300px;
		max-height: 300px;
		border: 1px solid #ccc;  
		outline: 1px solid #ccc;  
	}
	.wrapper td{
		position:relative;
		padding: 10px;
	}
	.infoBox{
		white-space: pre-wrap;
		overflow: hidden;
		font-family:verdana;
		padding: 5px;
		margin:3px;
		font-size: 13px;
	}
	.tableTop{
		z-index: 2;
		top: 40px;
		background-color: white;
		position:sticky;
		border-bottom: 3px solid #64cd93;
	}
	.clickable{
		cursor: pointer;
	}
	.ThumbnailIcon{
		width: 85px;
		height: 85px;
	}
	.Detail{
		width:40%
		min-width:300px;
	}
	.DetailContent{
		white-space: pre-wrap;
		overflow: hidden;
		font-family:verdana;
		padding: 5px;
		margin:3px;
		height: 50px;
		width: 95%;
		resize: none;
		border: 3px solid #64cd93;
		font-size: 15px;
	}
	.DetailContent:focus{
		overflow: visible;
		height: auto;
		min-height: 60px;
		border: 3px solid green;
	}
	.DetailAuthor{
		float: right;
		
	}
	.detailBox{
		width:80%;
	}
	.sendButton{
		background-color:#64cd93;
		color: white;
		border-radius: 10px;
		border:none;
		margin:5px;
	}
	.sendButton:hover{
		background-color:green;
	}
	.miniLogo{
		height:20px;
		width:auto;
	}
	.URLGetter{
		
	}
	.searchIcon{
		 position: relative;
		 font-size: 40px;
	}
	.searchButton{
		background-color: transparent;
		border:none;
	}
	.overallRatingTd{
		font-weight: bold;
		font-size: 19;
	}

	
	#headingTag{
		display:none;
	}
	.ratingStar{
		color:64cd93;
	}
	.filterDropdown{
		background-color: #1fd06f;
		padding:5px;
		margin:5px;
		border: none;
		color: white;
	}
	
	td .tooltip {
		visibility: hidden;
		width: 120px;
		background-color: black;
		color: #fff;
		text-align: center;
		border-radius: 6px;
		padding: 5px 0;

		/* Position the tooltip */
		position: absolute;
		z-index: 3;
		bottom: 100%;
		left: 50%;
		margin-left: -60px;
	}

	td:hover .tooltip {
		visibility: visible;
	}
	
	@media only screen and (min-width: 1000px) {
	  /* For desktop: */
		.toolbar {
			height:40px;
			min-width: 1050px;
		}
		.toolbar #searchThis{
			display: inline;
		}
		#content{
			margin: 50px auto 200px auto;
			min-width: 600px;
		}
		.extended{
			display:none;
		}
		.unextended{
			display:inline;
		}
		.searchIcon{
			font-size: 20px;
			display:none;
		}
		#searchWhat{
			display: inline;
			font-size: 14px;
			width: 400px;
		}
		.DetailContent{
			width: 95%;
		}
		.homeButton{
			height:30px;
		}
		.message{
			width: 50%;
			margin: 0 auto;
		}
	}
	

	
</style>
<div id = 'seoTag'></div>
<div id = 'headingTag'></div>
<meta name="viewport" content="width=device-width, initial-scale=.6, user-scalable=no">
</div>

<body>
	<div class = 'toolbar'>

		<div class = 'homeDiv'>
			<a class="home" href = '/' title = 'Home'><img class = 'homeButton' src = 'soundaboxBlack.png' alt = 'logo'></a>
		</div>
		<div class="search-container unextended" id = 'desktopSearch'>
		</div>
		
		<i class="fa fa-search searchIcon" onclick="showSearchBar()"></i>
		<div id ='userLogIn'></div>
	</div>
	
	<div class = "toolbar extended" id = 'mobileSearch'  style = 'display:none'>
	</div>
	<div id = 'content'>
	</div>
	<div id = 'contact'>
		If you have any suggestions, questions, or requests, contact us at zzxzzxzxzzxzzx@gmail.com
	</div>
	
</body>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-167905870-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-167905870-1');
</script>

<script type="text/javascript" src="//code.jquery.com/jquery-2.1.4.js"></script>
<script type="text/javascript" src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script></script>
<script type="application/ld+json" id =  "jsonld" >
	{
		"@context":"https://schema.org/",
		"@type":"AggregateRating",
		"itemReviewed":	{"@type":"CreativeWorkSeries","name":"Webtoon"},
		"ratingValue":10,
		"bestRating":"10",
		"ratingCount":"1"
	}
</script>


<script>//start ups and building blocks of the code
	//Create a search item for the search bar
	function toonURL($obj){
		return "/webtoon?title="+$obj.title+"&toon="+$obj.id;
	}
	
	function newSearchItem($title, $author, $score,$href,$img){
		var a = document.createElement("a");
		a.setAttribute('href', $href);
		a.setAttribute('class', "search");
		
		var div = document.createElement("div");
		div.setAttribute('class', 'autofillWords');
		
		var img = document.createElement("img");
		img.setAttribute('class', 'previewCover');
		img.setAttribute('src', $img);
		
		var text = document.createElement("div");
		text.setAttribute( "class", "searchDetail");
		text.innerHTML = $title+"\n";
		var author = document.createElement("span");
		author.setAttribute( "class", "searchAuthor");
		author.innerHTML = $author;
		text.appendChild(author);
		
		var score = document.createElement("span");
		score.setAttribute('class', 'searchScore');
		score.innerHTML = $score;
		
		
		div.appendChild(img);
		div.appendChild(text);
		div.appendChild(score);
		a.appendChild(div);
		return a;
	}
	
	//How many results found?
	function searchResults($results){
		var a = document.createElement("a");
		a.setAttribute('class', "search");
		
		var div = document.createElement("div");
		div.setAttribute('class', 'searchResults');
		
		var results = document.createElement("span");
		results.setAttribute('class', 'searchScore');
		results.innerHTML = $results + " results found. ";
		
		div.appendChild(results);
		a.appendChild(div);
		return a;
	}

	function detectMobile(){
		var isMobile = window.orientation > -1; 
		return isMobile;
	}
	//detects if mobile or desktop, then creates searchbar.
	function searchbarSwitch(){
		if (detectMobile()){
			document.getElementById('desktopSearch').innerHTML = '';
			createSearchBar(document.getElementById('mobileSearch'));
		}
		else{
			document.getElementById('mobileSearch').innerHTML = '';
			createSearchBar(document.getElementById('desktopSearch'));
		}
	}
	//build search bar
	function createSearchBar(el){
		var container = document.createElement("div");
		container.setAttribute('class', 'search-container');
		
		var select = document.createElement("select");
		select.setAttribute('id', 'searchThis');
		select.setAttribute('class', 'searchDropdown');
		
		var option = document.createElement("option");
		option.setAttribute('value', 'all');
		option.innerHTML = '&nbsp;&nbsp;All';
		
		var searchBox = document.createElement("div");
		searchBox.setAttribute('id', 'searchBox');
		
		var input = document.createElement("input");
		input.setAttribute('id', 'searchWhat');
		input.setAttribute('type', 'text');
		input.setAttribute('placeholder', '    Search for Webtoons...');
		input.setAttribute('name', 'search');
		input.setAttribute('autocomplete', 'off');
		
		var results = document.createElement("div");
		results.setAttribute('id', 'rightUnderSearchBar');
		
		var button = document.createElement("button");
		button.setAttribute('type', 'submit');
		button.setAttribute('class', 'searchButton');
		
		var icon = document.createElement("i");
		icon.setAttribute('class', 'fa fa-search searchIcon');
		icon.setAttribute('onclick', '');
		
		//put it together
		searchBox.appendChild(input);
		searchBox.appendChild(results);
				
		select.appendChild(option);
		
		button.appendChild(icon);
		
		//container.appendChild(select);
		container.appendChild(searchBox);
		//container.appendChild(button);
		el.appendChild(container);
	}
	
	//hide or show searchbar on mobile
	function showSearchBar(){
		if (document.getElementById('mobileSearch').getAttribute("style") == 'display:none')
		{
			document.getElementById('mobileSearch').setAttribute('style', '');	
		}
		else{
			document.getElementById('mobileSearch').setAttribute('style', 'display:none');
		}
	}
	
	//make remove ? from string
	function fixSearch($str){
		var str = $str.replace("?", "");
		return "?"+(str);
	}
	
	//Search bar: 
	function autocomplete(input){
		var arr = [];
		var currentFocus = -1;
		input.addEventListener("input", function(e) {
			
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				closeAllLists();
				var newObj = JSON.parse(this.responseText);
				var el = document.getElementById("rightUnderSearchBar");
				
				//just put the number of results here.
				el.appendChild(searchResults(newObj.length));
				for (i = 0; i < newObj.length; i++) {
					var obj = newObj[i];
					//$title, $author, $score,$href,$img
					el.appendChild(newSearchItem(obj.title, obj.author, obj.overallRating,toonURL(obj),obj.image));
				}
				
				if (document.getElementById('searchWhat').value.trim() == '')
				{
					closeAllLists();
				}
				
			}
		};
			

		//if (document.getElementById("searchThis").value == 'all')
		//{
			xhttp.open("POST", "getToon.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("search="+document.getElementById('searchWhat').value+"&searchThis=all");
		//}

		});
	
		input.addEventListener("keydown", function(e) {
			var el = document.getElementsByClassName("autofillWords");
			if (el)
			{
				//el = el.getElementsByTagName("div");
			}
			if (e.keyCode == 40){//down arrow
				currentFocus++;
				addActive(el);
			} 
			else if (e.keyCode == 38) { //up arrow
				currentFocus--;
				addActive(el);
			} 
			else if (e.keyCode == 13) {//enter
				if (currentFocus > -1) {
					e.preventDefault();
					if (el){ 
						el[currentFocus].click();
						currentFocus = -1;
					}
				}
			}
			else if (e.keyCode == 27) { //esc arrow
				document.getElementById('searchWhat').value = '';
				closeAllLists();
			}
	  });
		
		//add highlight to search
		function addActive(el) {
			if (!el) return false;
			removeActive(el);
			if (currentFocus >= el.length) {
				currentFocus = 0;
			}
			if (currentFocus < 0){
				currentFocus = (el.length - 1);
			}
			el[currentFocus].classList.add("autocomplete-active");
		}
		//removes all highlights from search
		function removeActive(el) {
			for (var i = 0; i < el.length; i++) {
				el[i].classList.remove("autocomplete-active");
			}
		}
		//close searches
		function closeAllLists(elmnt) {
			var el = document.getElementById("rightUnderSearchBar");
			el.innerHTML = "";
		}
		  /*execute a function when someone clicks in the document:*/
		document.addEventListener("click", function (e) {
			closeAllLists(e.target);
		});
	}
	
	//Lazy load
	var lastScrollTop = 0;
	var scrollReady = true; //makes sure gettoon doesnt happen two at a time
	window.onscroll = function(ev) {
		var st = window.pageYOffset || document.documentElement.scrollTop;

		//if scroll index = full scroll index
		if ((window.innerHeight + window.scrollY)+1 >= document.body.offsetHeight && scrollReady){
			var page = document.getElementById("page");

			getToon(fixSearch(window.location.search)+'&page='+page.value);
			//wait for response
			
		}
		lastScrollTop = st <= 0 ? 0 : st;
	};
	
	//Change filter url
	function newFilter(e){
		var href = addFilter(e.getAttribute('type'),e.value);
		//alert(href);
		history.pushState('', 'New URL: '+ href, href);
		clearRankingTable();
		getToon(window.location.search);
	}
	
	//replace type if it already exists
	function addFilter($type,$filter){
		var search = fixSearch(window.location.search).replace('?','').split('&');

		var found;
		found = false;
		for (var i = 0; i < search.length; i++) //[type=filter, type=filter, type=filter, etc...]
		{
			var type = search[i].split('=');
			
			if (type[0] == $type){//type already exists
				search[i] = $type + "=" + $filter; 
				found = true;
				//alert('found.');
			}
		}
		if (!found){//if new type of filter, add to array
			search.push($type + "=" + $filter);
			//alert('not found.');
		}
		
		//put back together
		var newHref = window.location.pathname+"?";
		
		var newSearchHref = '';
		for (var i = 0; i < search.length; i++)
		{
			newSearchHref =  newSearchHref + "&" + search[i];
			//alert(search[i]);
		}
		
		
		newHref += Trim(newSearchHref,'&');
		//alert(newHref);
		return newHref;
	}
	
	//trims certain characters
	function Trim($str,$ch) {
		var ch = $ch;
		ch = $ch.replace(/[|\\{}()[\]^$+*?.]/g, '\\$&');
		var reg = new RegExp('^'+ch+'+|'+ch+'+$', "gm");
		return $str.replace(reg,'');
	}

	


	//disable input on inputdisabled
   $('body').on('keypress', '[inputdisabled]',function(e){
		e.preventDefault();
	});
	
	//Expand description, but hide keyboard for mobile
	$('body').on('focus', '[inputdisabled]',function(e){
		if (detectMobile())
		{
			e.target.blur();
			e.target.setAttribute('style', 'overflow: visible;height: auto;min-height: 60px;border: 3px solid green;');
		}
	});
	
	//Save Info note
	$('body').on('keyup', '#infoNote',function(e){
		saveInfoNote();
	});
	
	//Compress description
	document.addEventListener("mousedown", function (e) {
		doc = document.getElementsByClassName('DetailContent');
		for (var i = 0; i < doc.length ; i++) 
		{
			doc[i].setAttribute('style', '');
		}
	});
	
	//remove href on url submitter
   $('body').on('input', '.submitWebtoon',function(e){
		var str = e.target.innerHTML.replace(/<(.|\n)*?>/g, '').trim();
		
		getNewToon(str);
	});
	
	//allow only numbers on ratings
	$('body').on('keypress keyup blur', '.ratingInner',function(e){
		//this.value = this.value.replace(/[^0-9\.]/g,'');
		$(this).val($(this).val().replace(/[^0-9\.]/g,''));
			if ((e.which != 46 || $(this).val().indexOf('.') != -1) && (e.which < 48 || e.which > 57)) {
				e.preventDefault();
				//alert(parseFloat(e.target.innerHTML));
				if (parseFloat(e.target.innerHTML) > 10)
				{
					e.target.innerHTML = 10;
					select(e.target);
				}
				else if (parseFloat(e.target.innerHTML) < 0)
				{
					e.target.innerHTML = 0;
					select(e.target);
				}
			}
			
		//calculates ratings every time you change input
		//calculateRatingTotal(e.target);
	});
	$('body').on('focus', '.ratingInner',function(e){
		select(e.target);
	});
	
	//When clicking on a link
	$('body').on('click', 'a',function(e){
		href = $(this).attr("href");
		if (href)
		{
			//alert(href);
			e.preventDefault();
			//if site is not soundabox.com: (All links on toonratings will not have "http://" manually.)
			//OR if control clicked...
			if (href.includes("https://")||e.ctrlKey)
			{
				//alert("a");
				window.open(href, "");
			}
			//default: load everything onto content div.
			else{
				loadURL('',href);
			}
		}
	});
	
	//when pressing the back/forward button(More specifically, when url changes) IT ERRORS BECAUSE loadURL KEEPS PUSHING OLD URL
	window.addEventListener('popstate', function(e){
		//alert(window.location.pathname+window.location.search);
		//loadURL('',window.location.pathname+window.location.search);
		window.location.replace(window.location.pathname+window.location.search);
		//alert(3);
	}, false);
	
	function changeJson($obj){
		var script = document.getElementById("jsonld");
		var json = {
			
		  "@context": "https://schema.org/",
		  "@type": "AggregateRating",
		  "itemReviewed": {
			"@type": "CreativeWorkSeries",
			"image": $obj.image,
			"name": $obj.title,
			"description": $obj.description
		  },
		  "ratingValue": $obj.overallRating,
		  "bestRating": "10",
		  "ratingCount": "1"
		};
		script.firstChild.nodeValue = JSON.stringify(json);
		//alert(script.firstChild.nodeValue);
		//script.innerHTML = "asd"; // Completely replace it
	}
	
	//Change Profile Picture
	function changeProfImage(input){
		var xhttp = new XMLHttpRequest();
		var formData = new FormData();
		formData.append("fileInput", input.files[0]);
		xhttp.open("POST", "uploadProf.php");
		xhttp.send(formData);
		
		if (input.files && input.files[0] && Validate(input) == "image") 
		{
			var reader = new FileReader();
			reader.onload = function (e) 
			{
				e.preventDefault();
				document.getElementById("profilePic").src = e.target.result;
			};
			reader.readAsDataURL(input.files[0]);
		}
		
		xhttp.onreadystatechange = function(){
			if (this.readyState == 4 && this.status == 200){
				//document.getElementById("content").innerHTML = "<img src = '"+this.responseText+"'/>";
				//alert(this.responseText);
			}
		}
	}
	
	//Checks file extension.
	function Validate(input){
		var validImageFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png", ".svg", ".bin"];
		var validSoundFileExtensions = [".mp3",".ogg", ".bin" ];
		for (var i = 0; i < input.files.length ; i++) 
		{
			for (var j = 0; j < validImageFileExtensions.length; j++) {
				if (getExtension(input.files[i].name) == validImageFileExtensions[j]) {
					return "image";
					break;
				}
			}
			for (var i = 0; i < input.files.length ; i++) 
			{
				for (var j = 0; j < validSoundFileExtensions.length; j++) {
					if (getExtension(input.files[i].name) == validSoundFileExtensions[j]) 
					{
						return "sound";
						break;
					}
				}
			}
		}
		return false;
	}
	
	//gets file extension.
	function getExtension(fileName){
		return "." + fileName.split('.').pop().toLowerCase();
	}
	
	//selects element
	function select(el){
		var range = document.createRange();
		range.selectNodeContents(el);
		var sel = window.getSelection();
		sel.removeAllRanges();
		sel.addRange(range);
	}

	//get the sibling element(Works all the time, but not efficient)
	function getSibling(event,$sibClass){
		var siblings = event.parentNode.children;
		for(var i = 0; i < siblings.length; i++) 
		{
			if(siblings[i].classList.contains($sibClass)) {
				return siblings[i];
			}
		}
		return siblings[0];
		//return false;
	}
		
		//get sibling of an element: (Efficient, but doesnt work all the time)
	function getSibling2(elem, selector){

		// Get the next sibling element
		var sibling = elem.nextElementSibling;

		// If there's no selector, return the first sibling
		if (!selector) return sibling;

		// If the sibling matches our selector, use it
		// If not, jump to the next sibling and continue the loop
		while (sibling) {
			if (sibling.matches(selector)) return sibling;
			sibling = sibling.nextElementSibling
		}
	};
	
	function clearContent(){
		document.getElementById('content').innerHTML = "";
	}
	
	//create table headings
	function createTableHeading(){
		var list = document.getElementById('list');
		
		var tr = document.createElement("tr");
		var th1 = document.createElement("th");
		var th2 = document.createElement("th");
		var th3 = document.createElement("th");
		var th4 = document.createElement("th");
		var th5 = document.createElement("th");
		var th6 = document.createElement("th");
		var th7 = document.createElement("th");
		var th8 = document.createElement("th");
		
		th1.setAttribute('class', 'tableTop');
		th2.setAttribute('class', 'tableTop');
		//th3.setAttribute('class', 'tableTop');
		th4.setAttribute('class', 'tableTop clickable');
		th5.setAttribute('class', 'tableTop clickable');
		th6.setAttribute('class', 'tableTop clickable');
		th7.setAttribute('class', 'tableTop clickable');
		th8.setAttribute('class', 'tableTop clickable');
		
		
		th1.innerHTML = 'No.';
		th2.innerHTML = 'Image';
		th3.innerHTML = 'Details';
		th3.setAttribute('class', 'detailBox tableTop');
		th4.innerHTML = 'Overall Rating';
		th5.innerHTML = 'User Rating';
		th6.innerHTML = 'Character/ Story';
		th7.innerHTML = 'Art/ Paneling';
		th8.innerHTML = 'Paneling';
		
		th4.setAttribute("onclick", "changeRanking('overallRating')");
		th5.setAttribute("onclick", "changeRanking('userRating')");
		th6.setAttribute("onclick", "changeRanking('storyRating')");
		th7.setAttribute("onclick", "changeRanking('artRating')");
		th8.setAttribute("onclick", "changeRanking('panelRating')");
		
		tr.appendChild(th1);
		tr.appendChild(th2);
		tr.appendChild(th3);
		tr.appendChild(th4);
		//tr.appendChild(th5);
		tr.appendChild(th6);
		tr.appendChild(th7);
		//tr.appendChild(th8);
		
		list.appendChild(tr);
	}
	
	function createRankingTable(){
		var $el = document.getElementById('content');
		
		var mainDiv = document.createElement("div");
		mainDiv.setAttribute('class', 'rankings');
		mainDiv.setAttribute('id', 'rankingTable');
		mainDiv.setAttribute('order', 'DESC');
		mainDiv.setAttribute('ranking', 'overallRating');
		var table = document.createElement("table");
		
		var tbody = document.createElement("tbody");
		tbody.setAttribute('id', 'list');

		table.appendChild(tbody);
		mainDiv.appendChild(table);
		$el.appendChild(mainDiv);
		createTableHeading();
	}
	
	//changes rankings type: overallRating userRating storyRating artRating
	//order from DESC or ASC
	function changeRanking(newRank){
		var rankingDiv = document.getElementById('rankingTable');
		var ranking = rankingDiv.getAttribute('ranking');//overallRating userRating storyRating artRating
		var order = rankingDiv.getAttribute('order');//DESC or ASC
		
		if (ranking == newRank){//change order if ranking type is the same
			if (order == 'DESC'){
				rankingDiv.setAttribute("order","ASC");
			}
			else{
				rankingDiv.setAttribute("order","DESC");
			}
		}
		else{//change ranking type
			rankingDiv.setAttribute("ranking",newRank);
			rankingDiv.setAttribute("order","DESC");
		}
		clearRankingTable();
		getToon(window.location.search);
	}
	//clears just list and resets pages
	function clearRankingTable(){
		var table = document.getElementById('list');
		table.innerHTML = '';
		createTableHeading();
		
		var page = document.getElementById('page');
		if (document.getElementById('page')){
			page.remove();
			createPages();
		}
	}
	
	
	function createReviewTable(){
		var $el = document.getElementById('content');
		
		var mainDiv = document.createElement("div");
		mainDiv.setAttribute('class', 'reviews');
		
		var table = document.createElement("table");
		table.setAttribute('id', 'opinionTable');
		
		var tbody = document.createElement("tbody");
		tbody.setAttribute('id', 'opinionBox');
		
		var tr = document.createElement("tr");
		
		var th1 = document.createElement("th");
		var th2 = document.createElement("th");
		var th3 = document.createElement("th");
		var th4 = document.createElement("th");
		var th5 = document.createElement("th");
		
		th1.innerHTML = '';
		th2.innerHTML = 'Reviews';
		th2.setAttribute('class', 'detailBox');
		th3.innerHTML = 'User Rating';
		th4.innerHTML = 'Character/ Story';
		th5.innerHTML = 'Art/ Paneling';
		
		tr.appendChild(th1);
		tr.appendChild(th2);
		tr.appendChild(th3);
		tr.appendChild(th4);
		tr.appendChild(th5);
		
		tbody.appendChild(tr);
		table.appendChild(tbody);
		mainDiv.appendChild(table);
		$el.appendChild(mainDiv);
	}
	function createPages(){
		var el = document.getElementById('content');
		
		var input = document.createElement("input");
		input.setAttribute('type', 'number');
		input.setAttribute('id', 'page');
		input.setAttribute('value', '0');
		input.setAttribute('style', 'display:none');
		el.appendChild(input);
	}
	
//list script
	
	//Calculates ratings for overall rating
	function calculateRating($rating){
		var newRating;
		var divider = 0;
		newRating = ($rating[0]+ ($rating[1]+$rating[2])/2)/2;
		if ($rating[0] > 0){
			divider += 2;
		}
		if ($rating[1] > 0){
			divider += 1;
		}
		if ($rating[2] > 0){
			divider += 1;
		}
		newRating = ($rating[0]*2+ ($rating[1]+$rating[2]))/divider;
		if (divider <= 0)
		{
			newRating = 0;
		}
		//alert($rating[0] +" "+$rating[1] +" "+$rating[2]);
		return newRating.toFixed(2);
	}
	
	//Calculates ratings based on the changes on list. THIS IS NOW USELESS
	function calculateRatingTotal(e){
		var newRating = [];
		newRating[0] = parseFloat(getSibling(getSibling(e.parentNode,"userRatingTd").childNodes[0],"ratingInner").innerHTML);
		
		if(getSibling(getSibling(e.parentNode,"storyRatingTd").childNodes[0],"ratingInner").innerHTML)
		{
			newRating[1] = parseFloat(getSibling(getSibling(e.parentNode,"storyRatingTd").childNodes[0],"ratingInner").innerHTML);
			newRating[2] = parseFloat(getSibling(getSibling(e.parentNode,"artRatingTd").childNodes[0],"ratingInner").innerHTML);
			//newRating[3] = parseFloat(getSibling(getSibling(e.parentNode,"panelRatingTd").childNodes[0],"ratingInner").innerHTML);
			getSibling(e.parentNode,"overallRatingTd").childNodes[0].innerHTML = calculateRating(newRating);//THIS HAS NOT BEEN TESTED AND MAY ERROR
		}
		//alert(newRating);
	}
	
	//makes and returns a single description box. ($description[4]: 0 for non editable, 1 for editable reviews, 2 for editable webtoons)
	function newDescription($description){
		var description = document.createElement("td");
		var descriptionTitle = document.createElement("div");
		var descriptionHref = document.createElement("a");

		
		descriptionTitle.setAttribute('class', 'DetailTitle');
		descriptionHref.innerHTML = $description[0];
		descriptionHref.setAttribute('href', $description[1]);
		descriptionTitle.appendChild(descriptionHref);
		
		//if url exists, make a link to it
		if ($description[7]){
			var descriptionUrl = document.createElement("a");
			var urlImage = document.createElement("img");
			urlImage.setAttribute('src', 'webtoonLogo.png');
			urlImage.setAttribute('class', 'miniLogo');
			descriptionUrl.setAttribute('href', $description[7]);
			descriptionUrl.appendChild(urlImage);
			descriptionTitle.appendChild(descriptionUrl);
		}
		
		description.appendChild(descriptionTitle);
		
		var descriptionContent = document.createElement("p");
		descriptionContent.setAttribute('class', 'DetailContent');
		
		
		
		var descriptionAuthor = document.createElement("div");
		descriptionAuthor.setAttribute('class', 'DetailAuthor');
		
		var descriptionAuthor2 = document.createElement("span");
		descriptionAuthor2.innerHTML = $description[3];
		descriptionAuthor2.setAttribute('class', 'Description');
		descriptionAuthor.appendChild(descriptionAuthor2);
		
		//input disabled if inputdisabled = true
		if ($description[4] == 0)//content not editable
		{
			descriptionContent.setAttribute('inputdisabled', '');
		}
		else if($description[4] == 3){//content is  a urlGetter and is editable(toon). Only add send button.
			
			var sendButton = document.createElement("button");

			descriptionContent.setAttribute('data-placeholder', 'Enter Description Here...');
			sendButton.innerHTML = "Submit";
			sendButton.setAttribute('editid',$description[5]);
			sendButton.setAttribute('uniqueid',$description[6]);
			sendButton.setAttribute('url',$description[7]);
			sendButton.setAttribute('onclick', 'newToon(this)');
			sendButton.setAttribute('class', 'sendButton');
			descriptionAuthor.appendChild(sendButton);
		}
		else if($description[4] == 1){//content is editable(review). Add send button.
			
			var sendButton = document.createElement("button");
			
			descriptionContent.setAttribute('data-placeholder', 'Enter Review Here...');
			sendButton.innerHTML = "Submit";

			sendButton.setAttribute('editid',$description[5]);
			sendButton.setAttribute('onclick', 'newReview(this)');
			sendButton.setAttribute('class', 'sendButton');
			descriptionAuthor.appendChild(sendButton);
			
			//delete button
			var deleteButton = document.createElement("button");
			deleteButton.innerHTML = "x";
			deleteButton.setAttribute('onclick', 'remove(this)');
			deleteButton.setAttribute('class', 'sendButton');
			deleteButton.setAttribute('delete', '-1');
			deleteButton.setAttribute('description', 'review');
			deleteButton.setAttribute('editid',$description[5]);
			descriptionAuthor.appendChild(deleteButton);
		}
		else if($description[4] == 2){//content is editable(toon). Add send button.
			
			var sendButton = document.createElement("button");

			descriptionContent.setAttribute('data-placeholder', 'Enter Description Here...');
			sendButton.innerHTML = "Submit";
			sendButton.setAttribute('editid',$description[5]);
			sendButton.setAttribute('uniqueid',$description[6]);
			sendButton.setAttribute('url',$description[7]);
			sendButton.setAttribute('onclick', 'newToon(this)');
			sendButton.setAttribute('class', 'sendButton');
			descriptionAuthor.appendChild(sendButton);
			
			//delete button
			var deleteButton = document.createElement("button");
			deleteButton.innerHTML = "x";
			deleteButton.setAttribute('onclick', 'remove(this)');
			deleteButton.setAttribute('class', 'sendButton');
			deleteButton.setAttribute('editid',$description[5]);
			deleteButton.setAttribute('delete', '-1');
			deleteButton.setAttribute('description', 'toon');
			descriptionAuthor.appendChild(deleteButton);
		}

		descriptionContent.setAttribute('contenteditable', '');
		descriptionContent.innerHTML = $description[2];
		description.appendChild(descriptionContent);
		
		description.appendChild(descriptionAuthor);
		return description;
	}
	
	//creates and returns single image box
	function newImage($image, $alt){
		var image = document.createElement("td");
		image.setAttribute('class', 'ThumbnailTd');
		var imageIcon = document.createElement("img");
		imageIcon.setAttribute('class', 'ThumbnailIcon');
		imageIcon.setAttribute('src', $image);
		imageIcon.setAttribute('alt', $alt);
		image.appendChild(imageIcon);
		return image;
	}
	
	//creates editable ratings for td's. ($name is not used.)
	function editableRating($rating,$editable,$name){
		var ratingInner = document.createElement("p");
		ratingInner.setAttribute('class', 'ratingInner');
		
		
		var ratingInner = document.createElement("p");
		ratingInner.setAttribute('class', 'ratingInner');
		//Logged in and is owner or admin. Input disabled if $editable = 0
		if($editable == 1 || $editable == 2){
			ratingInner.setAttribute('contenteditable', '');
			ratingInner.setAttribute('data-placeholder', 'Enter Rating Here...');
		}
		else{//Not editable
			ratingInner.setAttribute('inputdisabled', '');
		}
		ratingInner.innerHTML = $rating;
		return ratingInner;
	}
	
	//creates tooltip
	function createTooltip($text){
		var tooltip = document.createElement("span");
		tooltip.setAttribute('class', 'tooltip');
		tooltip.innerHTML = $text;
		return tooltip;
	}
	//1-10 rating meaning
	function ratingMeaning($rating){
		var str = '';
		switch(true){
			case ($rating >= 10): 
				str = "Masterpiece";
				break;
			case ($rating >= 9.5): 
				str = "Spectacular";
				break;
			case ($rating >= 8.5): 
				str = "Astounding";
				break;
			case ($rating >= 8): 
				str = "Awesome";
				break;
			case ($rating >= 7.75): 
				str = "Great";
				break;
			case ($rating >= 7.5): 
				str = "Very Good";
				break;
			case ($rating >= 7): 
				str = "Good";
				break;
			case ($rating >= 6.5): 
				str = "Average";
				break;
			case ($rating >= 6): 
				str = "Below Average";
				break;
			case ($rating >= 5): 
				str = "Needs Work";
				break;
			case ($rating >= 4): 
				str = "Poor";
				break;
			case ($rating >= 3): 
				str = "Terrible";
				break;
			case ($rating >= 2): 
				str = "Appalling";
				break;
			case ($rating > 0): 
				str = "DOGSHIT";
				break;
			default:
				str = "No rating";
		}
		/*
		10 - Masterpiece
9.5 - Perfect
9 - Spectacular
8.5 - Astounding
8 - Awesome
7.75 - Great
7.5 - Very Good
7.25 - Good
7 - Decent
6.5 - Average
6 - Below Average
5 - Needs Work
4 and below - Poor
^ Ours.
10 - Masterpiece
9.5 - Spectacular
9 - Awesome
8.5 - Great
8 - Very Good
7.5 - Good
7 - Decent
6.5 - Average
6 - Below Average
5 - Needs Work
4 - Poor
3 and below - Pitiful
^ Theirs.
*/
		return str;

	}
	
	//creates and returns overall rating box
	function newOverallRating($rating){
			var overallRating = document.createElement("td");
			overallRating.setAttribute('class', 'overallRatingTd');
			overallRating.appendChild(editableRating($rating[4].toFixed(2), 0,"overallRatingInner"));//replace 0 with $description[4] to make it editable
			overallRating.appendChild(createTooltip(ratingMeaning($rating[4])));
			
			
			//var star = document.createElement("i");
			//star.setAttribute('class', 'fa fa-star ratingStar');
			//overallRating.appendChild(star);
			return overallRating;
	}
	//creates and returns user rating box
	function newUserRating($rating,$description){
			var userRating = document.createElement("td");
			userRating.setAttribute('class', 'userRatingTd');
			userRating.appendChild(editableRating($rating[0], $description[4],"userRatingInner"));//replace 0 with $description[4] to make it editable
			userRating.appendChild(createTooltip(ratingMeaning($rating[0])));
			return userRating;
	}
	
	//creates and returns story rating box
	function newStoryRating($rating,$description){
			var storyRating = document.createElement("td");
			storyRating.setAttribute('class', 'storyRatingTd');
			storyRating.appendChild(editableRating($rating[1], $description[4],"storyRatingInner"));
			storyRating.appendChild(createTooltip(ratingMeaning($rating[1])));
			return storyRating;
	}
	
	//creates and returns art rating box
	function newArtRating($rating,$description){
			var artRating = document.createElement("td");
			artRating.setAttribute('class', 'artRatingTd');
			artRating.appendChild(editableRating($rating[2], $description[4],"artRatingInner"));
			artRating.appendChild(createTooltip(ratingMeaning($rating[2])));
			return artRating;
	}
	
	//creates and returns panel rating box
	function newPanelRating($rating,$description){
			var panelRating = document.createElement("td");
			panelRating.setAttribute('class', 'panelRatingTd');
			panelRating.appendChild(editableRating($rating[3], $description[4],"panelRatingInner"));
			panelRating.appendChild(createTooltip(ratingMeaning($rating[3])));
			return panelRating;
	}
		

	//Creates a single list to be added.
	function newList($rank,$json){
		var obj = JSON.parse($json);
		var url = "";
		if(obj.id != '0')	
		{
			url = toonURL(obj)
		}
		
		//title, href, description, author, input disabled?
		var $description = [obj.title,url,obj.description,obj.author,obj.admin,obj.id, obj.uniqueId, obj.url];
		//userRating, storyRating, artRating, panelRating
		var $rating = [obj.userRating,obj.storyRating,obj.artRating,obj.panelRating, obj.overallRating];
				
		
		var $el = document.getElementById('list');

		var list = 	document.createElement("tr");
		list.setAttribute("class", "wrapper");
		
		//$fullJson = JSON.stringify(obj.json);
		list.setAttribute('json', obj.json);		
		//simple number count: 1 2 3 4 5
		var rank = document.createElement("td");
		
		//make image(Image source, title)
		var image = newImage(obj.image, $description[0]);
		//make description box
		var description = newDescription($description);
		
		//make rating boxes
		
		var userRating = newUserRating($rating,[0,0,0,0,0]);//Replace the array with $description to make userRating editable when logged in
		var storyRating = newStoryRating($rating,$description);
		var artRating = newArtRating($rating,$description);
		var panelRating = newPanelRating($rating,$description);
		var overallRating = newOverallRating($rating);
		rank.innerHTML = $rank;

		
		//append
		list.appendChild(rank);
		list.appendChild(image);
		list.appendChild(description);
		list.appendChild(overallRating);
		//list.appendChild(userRating);
		//if (obj.admin >= 1){
			list.appendChild(storyRating);
			list.appendChild(artRating);
		//}
		//list.appendChild(panelRating);
		
		if($rank == '0')	
		{
			$el.prepend(list);
		}
		else{
			$el.appendChild(list);
		}
		
	}
	//Review box
	function newOpinionBox($image,$description,$rating){
		
		var list = 	document.createElement("tr");
		var el = document.getElementById('opinionBox');
				
		var image = newImage($image);
		
		var description = newDescription($description);

		var rating = newUserRating($rating,$description);
		var storyRating = newStoryRating($rating,$description);
		var artRating = newArtRating($rating,$description);
		//alert($description);
		list.setAttribute("class", "wrapper");
		
		list.appendChild(image);
		list.appendChild(description);
		list.appendChild(rating);
		list.appendChild(storyRating);
		list.appendChild(artRating);
		el.appendChild(list);
	}
	
	//more info on individual pages
	function newInfo($json){
		var obj = JSON.parse($json);
		var $el = document.getElementById('list');
		var tr = document.createElement("tr");
		tr.setAttribute("class", "wrapper");
		
		var numColSpan = $el.getElementsByTagName('th').length;
		var td = document.createElement("td");
		td.setAttribute("colspan", numColSpan);
		
		var p = document.createElement("p");
		p.setAttribute("class", "infoBox");
		
		p.innerHTML += "First Upload Date: "+obj.firstEpDate+"\n";
		p.innerHTML += "Last Upload Date: "+obj.lastEpDate+"\n";
		p.innerHTML += "Genre: "+obj.genre+"\n";
		p.innerHTML += "Number of Episodes: "+obj.numEpisodes+"\n";
		
		td.appendChild(p);
		tr.appendChild(td);
		$el.appendChild(tr);
	}
	
	//Makes box that gets information from webtoon URL
	function createURLGetter(){
		var el = document.getElementById('content');
		var getter = document.createElement("div");
		getter.setAttribute("class", "URLGetter");
		//getter.innerHTML = 'Webtoon URL:';
		
		var URL = document.createElement('p');
		URL.setAttribute("class", "submitWebtoon");
		URL.setAttribute("data-placeholder", "Enter Webtoon URL here...");
		URL.setAttribute("contenteditable", "");
		
		var URLInfo = document.createElement('p');
		URLInfo.setAttribute("id", "webtoonInfo");

		getter.appendChild(URL);
		getter.appendChild(URLInfo);
		
		el.appendChild(getter);
	}
	
	//Creates a note at the top of the page
	function createNote(){
		var el = document.getElementById('content');
		var note = document.createElement("div");
		var message = document.createElement("div");
		message.setAttribute("class", "message");
		
		var banner = document.createElement("div");
		var icon = document.createElement("img");
		banner.setAttribute("class", "banner");
		icon.setAttribute("class", "bannerIcon");
		icon.setAttribute("src", "soundaboxWhite.png");

		banner.appendChild(icon);
		banner.innerHTML += " TOONRATINGS\n";
		note.appendChild(banner);
		
		var str = "";
		str += "We rate comics based on the reading experience.\n";
		str += "A good story alone doesn't make a series enjoyable, and neither does the art.\n";
		str += "Sometimes, good paneling can save a comic that lacks in art and story.\n\n";
		str += "Here’s how we'll rate comics:\n";
		str += "	Story/Characters: \n";
		str += "		-The plot, potential, and character quality of the story\n";
		str += "	Art/Paneling: \n";
		str += "		-The style, flow, and dynamics of the illustrations\n";
		str += "	Overall Rating: \n";
		str += "		-Your objective rating for the series\n";	
		str += "		-Our score(The scores you see next to the overall rating) will count as one person's rating.\n";	
		message.innerHTML += str;
		
		var more = document.createElement("a");
		note.setAttribute("class", "note");
		more.setAttribute("href", "/moreinfo");
		more.setAttribute("class", "moreinfo");
		more.innerHTML = 'For more information, click here.';
		
		note.appendChild(message);	
		note.appendChild(more);
		el.appendChild(note);
		newHeading(str,2);
	}
	
	//Create note for more info on rating
	function createInfoNote($pageId){
		var el = document.getElementById('content');
		var note = document.createElement("p");
		var str = "";
		note.setAttribute("class", "note");
		note.setAttribute("id", "infoNote");
		note.setAttribute("pageId", $pageId);
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", 'https://toonratings.com/getInfo?page='+$pageId, true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send();
		xhttp.onreadystatechange = function(){
			if (this.readyState == 4 && this.status == 200){
				var obj = JSON.parse(this.responseText);
				str = obj.info;
				
				if (obj.admin == 2){
					note.setAttribute("contenteditable", "");
				}
				//alert(this.responseText);
				note.innerHTML = str;
				el.appendChild(note);
				newHeading(str,2);
			}
		}
	}
	//update and save info note.
	function saveInfoNote(){
		var xhttp = new XMLHttpRequest();
		var formData = new FormData();
		var pageId = document.getElementById('infoNote').getAttribute("pageId");
		xhttp.open("POST", "infoSubmit.php?pageId="+pageId, true);
		formData.append("info", document.getElementById('infoNote').innerHTML);
		xhttp.send(formData);
		xhttp.onreadystatechange = function(){
			if (this.readyState == 4 && this.status == 200) {
				//alert(this.reponseText+"ddd");
				//location.reload();
			}
		};
	}
	function seo($title, $description){
		var el = document.getElementById('seoTag');
		var title = document.createElement("title");
		var description = document.createElement("meta");
		var viewport = document.createElement("meta");
		
		title.innerHTML = $title;
		description.setAttribute("name", "description");
		description.setAttribute("content", $description);
		
		viewport.setAttribute("name", "viewport");
		viewport.setAttribute("content", "width=device-width, initial-scale=.6, user-scalable=no");
		
		el.innerHTML = '';
		el.appendChild(title);
		el.appendChild(description);
		el.appendChild(viewport);
		

	}
	function seoRating($rating){
		var el = document.getElementById('seoTag');
		var div = document.createElement("div");
		var span = document.createElement("span");
		
		div.setAttribute("itemdrop", "aggregateRating");
		div.setAttribute("itemscope", "");
		div.setAttribute("itemtype", "schema/AggregateRating");
		
		span.setAttribute("itemdrop", "ratingValue");
		span.innerHTML = $rating;
		
		div.innerHTML += "Rated";
		div.appendChild(span);
		div.innerHTML += "/10";
		
		//el.appendChild(div);
	}
	//clears heading tag for seo: h1,h2,etc
	function clearHeading(){
		var el = document.getElementById('headingTag');
		el.innerHTML = '';
	}
	//adds new heading for seo: h1,h2,etc
	function newHeading($content, $headingNum){
		var el = document.getElementById('headingTag');
		var heading = document.createElement("h"+$headingNum);
		heading.innerHTML = $content;
		el.appendChild(heading);
	}
	
	function createFilter(){
		var el = document.getElementById('content');
		var div = document.createElement("div");
		div.setAttribute("id", "filter");
		
		div.appendChild(createFilterOptions('genre','genreFilter', ["action","comedy","drama","fantasy","romance","sci-fi","short story","sports","superhero","supernatural","thriller"]));
		div.appendChild(createFilterOptions('status','statusFilter', ["ongoing","completed"]));
		div.appendChild(createFilterOptions('length','genreFilter', ["long","medium","short"]));
		
		if (!detectMobile()){
			el.appendChild(div);
		}
	}
	function createFilterOptions($type,$id, $options){
		var select = document.createElement("select");
		select.setAttribute("id", $id);
		select.setAttribute("class", "filterDropdown");
		select.setAttribute("type", $type);
		select.setAttribute("onchange", "newFilter(this)");
		
		var option = document.createElement("option");
			option.setAttribute("value", "");
			option.innerHTML = "&nbsp;&nbsp; Any "+$type.charAt(0).toUpperCase() + $type.slice(1);
			select.appendChild(option);
		for (i = 0; i < $options.length; i++){
			var option = document.createElement("option");
			option.setAttribute("value", $options[i]);
			option.innerHTML = "&nbsp;&nbsp;"+$options[i].charAt(0).toUpperCase() + $options[i].slice(1);
			select.appendChild(option);
		}
		return select;
	}


//Create chart

//<div id="chartContainer" style="height: 370px; width: 100%;"></div>
	function createChart(){
		var el = document.getElementById('content');
		var chart = document.createElement("div");//SWAP WITH DIV AND CANVAS
		
		chart.setAttribute("id", "chartContainer");
		chart.setAttribute("class", "chart");
		el.appendChild(chart);
		newHeading("Webtoon Subscribers Chart",2);
	}
	
	//Loads the chart
	function loadSubChart(subJson){
		
		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,
			theme: "light2",
			title:{
				text: "Subscribers"
			},
			axisY:{
				includeZero: false
			},
			axisY2:{
				includeZero: false
			},
			data: [{        
				type: "line",
				indexLabelFontSize: 12,
				dataPoints: typeDataPoints(subJson.subscribers)
			},
			{        
				type: "line",
				axisYType: "secondary",
				indexLabelFontSize: 12,
				dataPoints: typeDataPoints(subJson.views)
			}]
			
		});
		chart.render();
		
	/*
		var ctx = document.getElementById('chartContainer').getContext('2d');
		var chart = new Chart(ctx, {
			// The type of chart we want to create
			type: 'line',

			// The data for our dataset
			data: {
				labels: typeDatePoints(subJson),
				datasets: [{
					label: 'Subscribers',
					borderColor: 'rgb(100, 205, 147)',
					data: typeSubscriberPoints(subJson)
				}]
			},

			// Configuration options go here
			options: {}
		});	
	/**/
	}
	
	//returns data points(Date)(NOT IN USE)
	function typeDatePoints(subJson){
		var subscribers = JSON.parse(subJson);
		var dataPoints = [];
		for (obj in subscribers) {
			dataPoints.push(obj);
		}
		return dataPoints;
	}
		//returns data points(Subscriber numbers)(NOT IN USE)
	function typeSubscriberPoints(subJson){
		var subscribers = JSON.parse(subJson);
		var dataPoints = [];
		for (obj in subscribers) {
			dataPoints.push(subscribers[obj]);
		}
		return dataPoints;
	}
	//returns data points by date
	function typeDataPoints(json){
		if (json){
			var num = JSON.parse(json);
			var dataPoints = [];
			for (obj in num) {
				dataPoints.push({x: new Date(obj), y: num[obj]});
			}
			return dataPoints;
		}
	}



</script>

<script>//login script

	//Loads login automatically, then loads content
	function loading(){
		$username = document.getElementById("username");
		$password = document.getElementById("password");
		$verifyPassword = document.getElementById("verifyPassword");
		$contact = document.getElementById("contact");
		
		if($username){
			$usernameValue = $username.value;
		}
		else
		{
			$usernameValue = '';
		}
		
		if($contact){
			$contactValue = $contact.value;
		}
		else
		{
			$contactValue = '';
		}
		
		if($password){
			$passwordValue = $password.value;
		}
		else
		{
			$passwordValue = '';
		}
		
		if($verifyPassword){
			$verifyPasswordValue = $verifyPassword.value;
		}
		else
		{
			$verifyPasswordValue = '';
		}
		
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "log_options.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("&toonrating=1");
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("userLogIn").innerHTML = this.responseText;
			//alert(this.reponseText);
			//setQueue();
			loadURL('noHistoryPush',window.location.pathname+window.location.search);
			}
		};
	}
	
	var $session = '';
	function submitLog(input){
		if (input.keyCode === 13)
		{
			logging();
		}
	}
	
	//logs you in when you submit login
	function logging(){
		
		$username = document.getElementById("username");
		$password = document.getElementById("password");
		$verifyPassword = document.getElementById("verifyPassword");
		$contact = document.getElementById("contactHolder");
		
		if($username){
			$usernameValue = $username.value;
		}
		else
		{
			$usernameValue = '';
		}
		
		if($contact){
			$contactValue = $contact.value;
		}
		else
		{
			$contactValue = '';
		}
		
		if($password){
			$passwordValue = $password.value;
		}
		else
		{
			$passwordValue = '';
		}
		
		if($verifyPassword){
			$verifyPasswordValue = $verifyPassword.value;
		}
		else
		{
			$verifyPasswordValue = '';
		}
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "log_options.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("Log=Log&username="+$usernameValue+"&password="+$passwordValue+"&verifyPassword="+$verifyPasswordValue+"&contact="+$contactValue+"&toonrating=1");
		xhttp.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("userLogIn").innerHTML = this.responseText;
			//$session = document.getElementById("sessionID").value;	
			loadURL('',window.location.pathname+window.location.search);
		}};
	}
	
	//logs you out by calling log_out, then calling loading();.
	function logOut(){
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "log_out3.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send();
		xhttp.onreadystatechange = function(){
			if (this.readyState == 4 && this.status == 200) {
				loading();
				//loadURL('',window.location.pathname+window.location.search);
			}
		};
	}
	function loadURL(e, url){
		
		clearContent();
		clearHeading();
		newHeading("ToonRatings",1);
		newHeading("Webtoons",1);
		$pathinfo = url.split('?');

		var pathname = $pathinfo[0];
		var pathsearch = '?'+$pathinfo[1];
		//alert(pathname + "  "+ pathsearch);
		//href = window.location.pathname+window.location.search;
		if (pathname == 'log_out3')
		{
			logOut();
		}
		else{//if not logged out, push history to url
			if (e != "noHistoryPush"){
				history.pushState('', 'New URL: '+ url, url);
			}
		}
		
		if (pathname == '/webtoon')
		{
			
			createRankingTable();
			getToon(window.location.search);
			
			createReviewTable();
			getReview(window.location.search);
			
			var commentArr1 = ['','','','',1];
			var ratingArr = [0,0,0,0];
			newOpinionBox('thnail1.png', commentArr1,ratingArr);
		}
		if (pathname == '/moreinfo')
		{
			createInfoNote("1");
		}
		if (pathname == '/general')
		{
			createInfoNote("2");
		}
		else if(pathname == '/')
		{
			newHeading("Rating Webtoons Based on Reading Experience",1);
			newHeading("We rate comics based on the reading experience. A good story alone doesn't make a series enjoyable, and neither does the art.	Sometimes, good paneling can save a comic that lacks in art and story.",2);
			createNote();
			
			createFilter();
			
			createURLGetter();
			createRankingTable();
			
			getToon(window.location.search);//To fix, getToon('')
			createPages();
			seo("ToonRatings: Rating Webtoons Based on Reading Experience","We rate comics based on the reading experience. A good story alone doesn't make a series enjoyable, and neither does the art.	Sometimes, good paneling can save a comic that lacks in art and story.");
		}
		else if(pathname == '/refreshall')
		{
			createURLGetter();
			createRankingTable();
			
			scrollReady = false;
			
			var xhttp = new XMLHttpRequest();
			//var limit = 15; //how many webtoons to load?
			
			xhttp.open("POST", 'https://toonratings.com/getToon', true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			//xhttp.send("limit="+limit);
			xhttp.send();
			xhttp.onreadystatechange = function(){
				if (this.readyState == 4 && this.status == 200){
					//alert(this.responseText);
					var newObj = JSON.parse(this.responseText);
					var page = 0;
					for (let i = 0; i < newObj.length; i++){
						var obj = newObj[i];
						task(i,obj.url);
						
					}
					//alert("starting");
					//var i = 0;
					//task2(i,newObj);
				};
			}
			
		}
	}

	//Gets info from url once a second
	function task(i,url) { 
	  setTimeout(function() {
			getNewToon(url);
	  }, 1000 * i); 
	}
	function task2(i,fullList) {//loads as soon as previous one loads
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", '', true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send();
		xhttp.onreadystatechange = function(){
			if (this.readyState == 4 && this.status == 200){
				if (i < fullList.length){
					getNewToon(fullList[i].url);
					task2(i+1,fullList);
				}
			}
		}
	}

	//automatically submits all.
	function autosubmit(){
		var sendButtons = document.getElementsByClassName('sendButton');
		sendButtons[0].click();
	}

</script>

<script>

//script for adding columns to mysql
	var counter = 0;
	//Get Webtoon Information from URL. Only usable when submit button is available on a webtoon list.
	function getNewToon($str){
		var xhttp = new XMLHttpRequest();
		var formData = new FormData();

		xhttp.open("POST", "toonSubmitter.php", true);
		$str = $str.split("&")[0];
		formData.append("url", $str);
		xhttp.send(formData);
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {	
				//document.getElementById('webtoonInfo').innerHTML = this.responseText;
				var obj = JSON.parse(this.responseText);
				//title, href, description, author, input disabled?
				//var descriptionArr = [obj.title,'',obj.description,obj.author,obj.admin,obj.id, obj.uniqueId, obj.url];
				//userRating, storyRating, artRating, panelRating
				//var ratingArr = [obj.userRating,obj.storyRating,obj.artRating,obj.panelRating];
				//alert(this.responseText);
				if (obj.uniqueId > 0)//Makes sure the url is a webtoon url.
				{
					//newList(0,obj.image,descriptionArr,ratingArr);
					newList(0,this.responseText);
					//autosubmit();//Use on /refreshall
				}
				counter++;
				document.getElementById('searchWhat').value = counter;
			}
			if (this.readyState == 4 && this.status == 500){//if error, retry
				//alert('error' + $str);
				getNewToon($str);
			}
		};
	}

	//Loads Webtoon data from Mysql
	function getToon(pathsearch){
		scrollReady = false;
		var xhttp = new XMLHttpRequest();
		var limit = 15; //how many webtoons to load?
		
		
		//May be able to move pages down here in the future, but will be hard.
		var rankingDiv = document.getElementById('rankingTable');
		var rankingValues = '&ranking='+rankingDiv.getAttribute('ranking')+'&order='+rankingDiv.getAttribute('order');
		
		//alert('https://toonratings.com/getToon'+fixSearch(pathsearch+rankingValues));
		//wait for response
		xhttp.open("POST", 'https://toonratings.com/getToon'+fixSearch(pathsearch+rankingValues), true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("limit="+limit);
		xhttp.onreadystatechange = function(){
			if (this.readyState == 4 && this.status == 200){
				//alert(this.responseText);
				var newObj = JSON.parse(this.responseText);
				var page = 0;
				
				if (document.getElementById("page"))
				{
					page = document.getElementById("page").value * limit;
				}
				for (i = 0; i < newObj.length; i++){
					var obj = newObj[i];
					var rank = 1;
					//title, href, description, author, input disabled/review/toon, unique id
					//var descriptionArr = [obj.title,'/webtoon?toon='+obj.id,obj.description,obj.author,obj.admin,obj.id,obj.uniqueId, obj.url];
					//userRating, storyRating, artRating, panelRating
					//var ratingArr = [obj.userRating,obj.storyRating,obj.artRating,obj.panelRating];
					//newList(i+page+1,obj.image,descriptionArr,ratingArr);
					if (obj.order == 'ASC'){//Ranking order descending or ascending.
						rank = obj.count-(i+page);
					}
					else{
						rank = i+page+1;
					}
					newList(rank,JSON.stringify(obj));//i+page+1
				} 

				//if <input id = page> exists and returned a webtoon, add 1 to page value. (For the ranking list)
				if(document.getElementById("page") && newObj.length > 0)
				{
					//alert(window.innerHeight + window.scrollY +"  :  "+document.body.offsetHeight);
					document.getElementById("page").value++;//add value to the invisible page number
					scrollReady = true;
				}
				//If on /webtoon?..., change seo and 
				else if (!document.getElementById("page") && newObj.length == 1)
				{
					if(obj.json){
						newInfo(obj.json);
					}
					seo(obj.title + " - " + obj.author,obj.description);
					seoRating(obj.overallRating)
					changeJson(newObj[0]);
					clearHeading();
					newHeading("Webtoon",1);
					newHeading(newObj[0].title,1);
					newHeading(newObj[0].description,2);
					newHeading(newObj[0].author,2);
					//var subscribers = JSON.parse(obj.subscribers);
					//alert(subscribers["2020/06/21"]);
					if (obj.subscribers){//If subscriber data available...
						createChart();
						loadSubChart(obj);
					}
				}
			}
		};
	}
	
	//Loads reviews for a webtoon from Mysql
	function getReview(pathsearch){

		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", 'https://toonratings.com/getReview'+pathsearch, true);

		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				//alert(this.responseText);
				var newObj = JSON.parse(this.responseText);
				
				for (i = 0; i < newObj.length; i++) {
					
					var obj = newObj[i];
					
					//username, href, review, author, date, input disabled?, id
					var description = [obj.username,'',obj.review, obj.date,obj.reviewOwner,obj.id];
					//userRating/storyRating.artRating/PanelRating/editable?
					var ratingArr = [obj.userRating,obj.storyRating,obj.artRating,obj.panelRating];
					newOpinionBox('user/'+obj.userId+'ProfPic.jpg', description,ratingArr);
					newHeading(obj.review,2);
				}
			}
		};
	}
	
	//Add or update a new toon(STILL UNFINISHED)
	function newToon(e){
		var xhttp = new XMLHttpRequest();
		var formData = new FormData();

		xhttp.open("POST", "toonSubmit.php", true);
		
		formData.append("title", getSibling(e.parentNode,"DetailTitle").childNodes[0].innerHTML);
		formData.append("image", getSibling(getSibling(e.parentNode.parentNode,"ThumbnailTd").childNodes[0],"ThumbnailIcon").src);
		formData.append("description", getSibling(e.parentNode,"DetailContent").innerHTML);
		formData.append("author", getSibling(e,"Description").innerHTML);
		//formData.append("userRating", getSibling(getSibling(e.parentNode.parentNode,"userRatingTd").childNodes[0],"ratingInner").innerHTML);
		formData.append("storyRating", getSibling(getSibling(e.parentNode.parentNode,"storyRatingTd").childNodes[0],"ratingInner").innerHTML);
		formData.append("artRating", getSibling(getSibling(e.parentNode.parentNode,"artRatingTd").childNodes[0],"ratingInner").innerHTML);
		//formData.append("panelRating", getSibling(getSibling(e.parentNode.parentNode,"panelRatingTd").childNodes[0],"ratingInner").innerHTML);
		formData.append("overallRating", getSibling(getSibling(e.parentNode.parentNode,"overallRatingTd").childNodes[0],"ratingInner").innerHTML);
		formData.append("uniqueId", e.getAttribute("uniqueid"));
		formData.append("url", e.getAttribute("url"));
		formData.append("json", e.parentNode.parentNode.parentNode.getAttribute("json"));
		formData.append("editId", e.getAttribute("editid"));
		//alert(e.parentNode.parentNode.parentNode.getAttribute("json"));
		//alert(getSibling(e.parentNode.parentNode,"overallRatingTd").innerHTML);
		//formData.append("url", $url);
		//alert(getSibling(e.parentNode,"DetailTitle").childNodes[0].innerHTML);
		//alert(getSibling(e.parentNode,"DetailContent").innerHTML);
		//alert(getSibling(e,"Description").innerHTML);
		//alert(getSibling(getSibling(e.parentNode.parentNode,"userRatingTd").childNodes[0],"ratingInner").innerHTML);
		//formData.append("editId", $editId);
		xhttp.send(formData);
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200){	
				//alert(this.responseText);
				e.parentNode.parentNode.parentNode.remove();
				clearRankingTable();
				getToon(window.location.search);
			}
		};
	}
	
	//Add or update a review(STILL UFINISHED): You acutally have to be logged in to comment, or sql errors.
	function newReview(e){
		//get sibling element with class name, "DetailContent"
		
		var xhttp = new XMLHttpRequest();
		var formData = new FormData();
		xhttp.open("POST", "reviewSubmit.php"+window.location.search, true);
		//alert("reviewSubmit.php"+window.location.search);
		//alert(getSibling(e,"DetailContent").innerHTML);
		formData.append("review", getSibling(e.parentNode,"DetailContent").innerHTML);
		formData.append("userRating", getSibling(getSibling(e.parentNode.parentNode, "userRatingTd").childNodes[0],"ratingInner").innerHTML);
		formData.append("storyRating", getSibling(getSibling(e.parentNode.parentNode, "storyRatingTd").childNodes[0],"ratingInner").innerHTML);
		formData.append("artRating", getSibling(getSibling(e.parentNode.parentNode, "artRatingTd").childNodes[0],"ratingInner").innerHTML);
		formData.append("editId", e.getAttribute("editid"));
		xhttp.send(formData);
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				//alert(this.responseText);
				location.reload();
			}
		};
	}
	//Removes a toon or a review.
	function remove(e){
		//get sibling element with class name, "DetailContent"
		
		var xhttp = new XMLHttpRequest();
		var formData = new FormData();
		
		if(e.getAttribute("description") == 'toon'){
			xhttp.open("POST", "toonSubmit.php", true);
		}
		else if(e.getAttribute("description") == 'review'){
			xhttp.open("POST", "reviewSubmit.php"+window.location.search, true);
		}
		//alert("reviewSubmit.php"+window.location.search);
		//alert(getSibling(e,"DetailContent").innerHTML);
		formData.append("editId", e.getAttribute("editid"));
		formData.append("active", e.getAttribute("delete"));
		xhttp.send(formData);
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				//alert(this.responseText);
				location.reload();
			}
		};
	}

</script>

<script>
	searchbarSwitch();
	loading();
	autocomplete(document.getElementById("searchWhat"));

//For calling functions
/*
	createRankingTable();
	//createReviewTable();
	
		//title, href, description, author, input disabled?
	var descriptionArr = ['title','https://toonratings.com/webtoon?toon=1','A story about a Giant who finds a human child in the middle of a blizzard. Turns out the kid brings more trouble than he ever imagined','By Bob',true];
	 
	//userRating, storyRating, artRating, panelRating
	var ratingArr = [10,1,1,1];
	
	//getToon(window.location.search);
	
	newList(1,'https://webtoon-phinf.pstatic.net/20200408_175/1586285129590L5Vhl_PNG/d6d2b721-f621-45bf-8e59-5209dd7c5788.png',descriptionArr,ratingArr);
	newList(3,'https://webtoon-phinf.pstatic.net/20200408_175/1586285129590L5Vhl_PNG/d6d2b721-f621-45bf-8e59-5209dd7c5788.png',descriptionArr,ratingArr);
	newList(8,'https://webtoon-phinf.pstatic.net/20200408_175/1586285129590L5Vhl_PNG/d6d2b721-f621-45bf-8e59-5209dd7c5788.png',descriptionArr,ratingArr);
*/
	//newReview();

</script>



























