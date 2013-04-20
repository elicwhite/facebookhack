<section data-role="page" id="front-page">
	<header data-role="header">
		<h1>Facebook Re-Connect</h1>
	</header>
	
	<section data-role="content">
		<form id="search-form">
			<p><input type="search" id="search" placeholder="User Search"></p>
		</form>
		<ul id="results" data-role="listview"></ul>
	</section>
</section>

<section data-role="page" id="show-timeline" data-add-back-btn="true">
	<header data-role="header">
		<img id="avatar">
		<h1></h1>
		<h2></h2>
	</header>
	
	<section data-role="content">
		<ul id="user_stats">
			<li id="user_friends">
				<strong></strong>
				<small>Friends</small>
			</li>
			<li id="user_location">
				<small>Location</small>
				<strong></strong>
			</li>
		</ul>
		<ul id="timeline" data-role="listview" data-inset="true"></ul>
	</section>
</section>