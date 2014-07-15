<?php
include ('Player.php');
include ('DB.php');
include ('loginfunctions.php');
sec_session_start();
if (login_check($mysqli) == true) {

} else {
	//    echo 'You are not authorized to access this page, please login. <br/>';
	//    header('Location: index.php?timeout=yes');
	//    exit();
	//    die();
}
//$timeOut = 12 * 3600; //Tid innan session expirar i sekunder.
?>
<html>
	<head>
		<title>BeachTime</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<META NAME="description" CONTENT="Time for beachvolleyball? Time for BeachTime!">
		<link rel="shortcut icon" href="favicon.ico" >
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" />
		<link rel="stylesheet" href="css/style.css?version=2324324442222221411">
		<link rel="stylesheet" href="css/TimeCircles.css" >
		<link rel="stylesheet" href="css/themes/beachTheme.css?122" />
		<link rel="stylesheet" href="css/themes/jquery.mobile.icons.min.css" />
		<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>

		<!--        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>-->
		<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
		<script type="text/javascript" src="js/TimeCircles.js"></script>
		<script type="text/javascript" src="js/main.js?1223235"></script>
		<script type="text/javascript" src="js/statistik.js?11111221121122"></script>
		<script type="text/javascript" src="js/adminScript.js?5243444433342444221"></script>
		<script type="text/javascript" src="js/sha512.js"></script>
		<script type="text/javascript" src="js/forms.js"></script>
	</head>
	<body onload="onBodyLoad()">
		<div data-role="page" id="login">
			<div data-theme="b" data-role="header" data-id="persistent" data-position="fixed">
				<h1>BeachTime</h1>
			</div>
			<div data-role="content">
				<div class="logRegDiv">
					<p id="errorText"></p>
					<form class="logInner" data-ajax="false" id="login_form"  action="" method="post"  name="login_form">

						<input placeholder="Email" type="text" id="mail" name="email" />
						<input placeholder="Lösenord" type="password" name="password" id="password"/>
						<br />

						<a data-role="button" value="Registrera" href="#register">Register</a>
						<input data-theme="b" class="logButton" id="submitButton" type="submit" action="submit" value="Login" />
					</form>
					<p  id="newUser"></p>
				</div>
			</div><!-- /content -->

			<div class="ui-bar-b" data-theme="a" data-role="footer"  data-id="persistent" data-position="fixed">
				<h4>BeachTime</h4>
			</div>
		</div>
		<div data-role="page" id="register">
			<div data-theme="b" data-role="header" data-id="persistent" data-position="fixed">
				<h1>BeachTime</h1>
			</div>
			<div data-role="content">
				<div class="logRegDiv">
					<form autocomplete="off" data-ajax="false"  class="regInner" id="registerForm" name="registerForm" action="#">
						<input autocomplete="off" placeholder="Username" type="text" id="regUser" />
						<input autocomplete="off" placeholder="Email" type="text" id="regEmail" />
						
						<input autocomplete="off" placeholder="Password" type="password" name="password" id="regPassword"/>
						<input type="text" name="fakeN" style="display:none">
						<input type="password" name="fakeP" id="regPass" style="display:none">

						<a data-role="button" value="Avbryt" href="#login">Cancel</a>
						<input data-role="button" data-theme="b" class="logButton"  type="submit" action="submit" value="Register" />
					</form>
				</div>
			</div><!-- /content -->

			<div data-theme="a" data-role="footer"  data-id="persistent" data-position="fixed">
				<h4>Register</h4>
			</div>
		</div>

		<!-- --------------Adminsida----------------- -->

		<div data-role="page" id="admin">
			<div data-theme="a" data-role="header" data-id="persistent" data-position="fixed">
				<div data-role="navbar" data-iconpos="top">
					<ul>
						<li>
							<a class="ui-btn-active ui-state-persist" data-icon="gear" data-theme="a" href="index.php#admin">Settings</a>
						</li>
						<li>
							<a  data-icon="edit" data-theme="a"    href="index.php#prepp">Prep</a>
						</li>
						<li>
							<a  data-icon="grid" data-theme="a" href="index.php#matcher">Matches</a>
						</li>
						<li>
							<a  data-icon="star" data-theme="a" href="index.php#statistik">Statistics</a>
						</li>
					</ul>
				</div><!-- /navbar -->
			</div>

			<div data-role="content">
				<div id="startPageGrid" class="matchBreak ui-grid-b">
					<div id="addPlayah" class="ui-block-a">

						<label for="courts">Courts</label>
						<input type="range" name="courts" id="courts" min="0" max="20" />
						<br>
						<label for="timeSlide">Minutes:</label>
						<input type="range" name="timeSlide" id="timeSlide"  min="0" max="45">
						<!--                        <a href="#" data-role="button">Set time</a>-->
						<br/>
						<a href="#.php" id="setButton" data-role="button" data-theme="a">Apply</a>
						<br>
						<a href="logout.php" id="logoutButton" data-icon="delete" data-role="button">Log out</a>
						<br>
					</div>
					<div id="middleStart" class="ui-block-b">
						<form id="addPlayerForm">
							<ul id="addPlayerUl" data-role="listview" data-inset="true" class="ui-corner-all">
								<li>
									<label class="ui-hidden-accessible" for="infname">Förnamn:</label>
									<input placeholder="First name" name="infname" type="text">
								</li>
								<li>
									<label class="ui-hidden-accessible" for="inlname">Efternamn:</label>
									<input placeholder="Last name" name="inlname" type="text">
								</li>
								<li id="sexRadios" data-role="fieldcontain">
									<fieldset   id="insexRadio"  data-role="controlgroup" data-type="horizontal" data-role="fieldcontain">
										<label  for="insexM">Male</label>
										<input  type="radio" name="insex" id="insexM"value="M"/>
										<label  for="insexF">Female</label>
										<input type="radio" name="insex" id="insexF" value="F"/>
									</fieldset>
								</li>
								<!--                                <li data-role="fieldcontain">
								<fieldset  id="inmember" data-role="controlgroup" data-type="horizontal" data-role="fieldcontain">
								<label for="inmemberY">Medlem</label>
								<input type="radio" name="inmember" id="inmemberY"value="Y"/>
								<label for="inmemberN">Icke-medlem</label>
								<input type="radio" name="inmember" id="inmemberN" value="N"/>
								</fieldset>
								</li> -->
								<li>
									<input data-theme="b" type="submit" value="Add player">
									<p id="resultatP" class="hidden"></p>
								</li>
							</ul>

						</form>

					</div>
					<div id="rightStart" class="ui-block-c">
						<br>
						<ul  id="mainPlayerList" data-role="listview" data-autodividers="true" data-filter="true" data-inset="true" data-sort="true">

						</ul>
					</div>

				</div>
			</div><!-- /content -->
			<div class="ui-bar-b" data-theme="a" data-role="footer"  data-id="persistent" data-position="fixed">
				<h4  class="sessionDisp"></h4>
			</div>

			<div id="editPlayer" data-role="popup"  data-transition="pop">
				<div data-role="header">
					<h1 class="ui-content">Edit player</h1>
				</div>
				<div data-role="content">
					<form id="editPlayerForm">
						<input type="hidden" id="idChange"/>
						<ul id="editPlayerUl" data-role="listview" data-inset="true" >
							<li>
								<label class="ui-hidden-accessible" for="edinfname">Förnamn:</label>
								<input placeholder="Förnamn" id="edinfname" name="edinfname" type="text">
							</li>
							<li>
								<label class="ui-hidden-accessible" for="edinlname">Efternamn:</label>
								<input placeholder="Efternamn" id="edinlname" name="edinlname" type="text">
							</li>
							<li data-role="fieldcontain">
								<fieldset  id="edinsexRadio" data-role="controlgroup" data-type="horizontal" >
									<label for="edinsexM">Male</label>
									<input type="radio" name="edinsex" id="edinsexM" value="M"/>
									<label for="edinsexF">Female</label>
									<input type="radio" name="edinsex" id="edinsexF" value="F"/>
								</fieldset>
							</li>
							<!--                        <li data-role="fieldcontain">
							<fieldset  id="edinmember" data-role="controlgroup" data-type="horizontal" data-role="fieldcontain">
							<label for="edinmemberY">Medlem</label>
							<input type="radio" name="edinmember" id="edinmemberY" value="Y"/>
							<label for="edinmemberN">Icke-medlem</label>
							<input type="radio" name="edinmember" id="edinmemberN"  value="N"/>
							</fieldset>
							</li> -->
							<!--                            <li data-role="fieldcontain">
							<label for="edinPlayed">Spelade: </label>
							<input placeholder="Spelade" name="edinPlayed" id="edinPlayed" type="text">
							</li>
							<li data-role="fieldcontain">
							<label for="edinWins">Vinster: </label>
							<input placeholder="Vinster" id="edinWins" name="edinWins" type="text">
							</li>
							<li data-role="fieldcontain">
							<label for="edinRests">Vilade: </label>
							<input placeholder="Vilade" id="edinRests" name="edinRests" type="text">
							</li> -->

						</ul>

						<!--                        <a data-icon="delete" href="#" data-role="button" data-rel="back" data-theme="a">Cancel</a>-->
						<button id="changePlayerButton" type="submit" data-icon="edit" href="#" data-theme="b">
							Make changes
						</button>
					</form>
				</div>
			</div>
		</div><!-- /page -->

		<!-- --------------Preppsida----------------- -->

		<div data-role="page" id="prepp">
			<div data-theme="a" data-role="header" data-id="persistent" data-position="fixed">

				<div data-role="navbar" data-iconpos="top">
					<ul>
						<li>
							<a  data-icon="gear" data-theme="a" href="index.php#admin">Settings</a>
						</li>
						<li>
							<a class="ui-btn-active ui-state-persist" data-icon="edit"    data-theme="a" href="index.php#prepp">Prep</a>
						</li>
						<li>
							<a  data-icon="grid" data-theme="a" href="index.php#matcher">Matches</a>
						</li>
						<li>
							<a  data-icon="star" data-theme="a" href="index.php#statistik">Statistics</a>
						</li>

					</ul>
				</div><!-- /navbar -->
			</div>

			<div  data-role="content">
				<div class="mainPrepp" id="left">

					<ul id="filterPlayers" data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="Type a player name" data-filter-theme="a"></ul>

					<label class="ui-hidden-accessible" for="all" class="select">Hela databasen:</label>
					<SELECT  data-iconpos="left" data-native-menu="false" multiple="multiple" id="allSelect" name="all">
						<option class="headSel">List of all players</option>
					</SELECT>

					<div style="width:100px; margin: 0 auto;">
						<input data-theme="b" type="button" data-inline="true" data-iconpos="notext" data-iconpos="top"  data-icon="arrow-u" id="toAll" name="toAll" />
						<input data-theme="b" type="button" data-inline="true" data-iconpos="notext" data-iconpos="top"  data-icon="arrow-d" id="toDay" name="toDay" />
					</div>

					<div class="ui-grid-a">
						<div class="ui-block-a">
							<label class="ui-hidden-accessible" for="daySelect" class="select">Chosen to play</label>
							<SELECT data-iconpos="left" data-native-menu="false" multiple="multiple" id="daySelect" name="day" >
								<option class="headSel">Chosen to play</option>
							</SELECT>
						</div>
						<div class="ui-block-b">
							<a href="#" id="makePair" data-role="button" data-icon="grid"  data-iconpos="notext">Make pair</a>
						</div>
					</div>
					<div style="width:100px; margin: 0 auto;">
						<input data-inline="true" data-iconpos="notext" data-theme="b" type="button" class="arrows"  name="fromRest" data-icon="arrow-u">
						<input data-inline="true" data-iconpos="notext" data-theme="b" type="button" class="arrows" name="toRest" data-icon="arrow-d">
					</div>

					<label class="ui-hidden-accessible" for="restSelect" class="select">Chosen to play:</label>
					<SELECT data-iconpos="left" id="restSelect" name="rest" data-native-menu="false" multiple="multiple">
						<!--VILANDE SPELARE -->
						<option class="headSel">Chosen to rest</option>

					</SELECT>
					<br>
					<div class="ui-grid-a">
						<div class="ui-block-a">
							<fieldset  class="firstPageButtons" id="prioRest" data-role="controlgroup" data-type="horizontal">
								<input type="radio" value="true" id="restTrue" name="prioRest" checked="checked" />
								<label for="restTrue">1</label>
								<input type="radio" value="false2" id="restFalse" name="prioRest"  />
								<label for="restFalse">2</label>
								<input type="radio" value="false" id="randomRest" name="prioRest"  />
								<label for="randomRest">3</label>
							</fieldset>
						</div>
						<div class="ui-block-b">
							<a href="#" id="playModeI" data-role="button"  data-iconpos="notext" data-icon="info">Info</a>
						</div>
					</div>
					<input type="button"  data-icon="star" name="matchning" value="Match chosen players!">

					<br>

				</div>
				<div  class="sidePrepp" id="middle">
					<div id="loadedSession">
						Du har återupptagit en gammal session - tänk på att:
						<ul>
							<li>
								Alla spelare från sessionen är valda - manuellt vilande måste väljas om
							</li>
							<li>
								Om en spelare tagits bort under sessionen, och en annan fått dennes nummer, har spelare 1 fått ett nytt nummer nu.
							</li>
						</ul>

					</div>
					<div id="dayListContainer">
						<ul id="dayList" data-split-icon="star" data-role="listview" data-inset="true" data-divider-theme="a" data-theme="b"></ul>
					</div>
				</div>
			</div>
			<div class="ui-bar-b" data-theme="a" data-role="footer"  data-id="persistent" data-position="fixed">

				<h4 class="sessionDisp"></h4>
			</div>
			<div id="editPlayerBN" data-role="popup"  data-transition="pop">
				<div data-role="header">
					<h1 class="ui-content">Edit player</h1>
				</div>
				<div data-role="content">
					<form id="editPlayerBNForm">
						<input type="hidden" id="idBNChange"/>
						<ul id="editPlayerBNUl" data-role="listview" data-inset="true" >
							<li>
								<label class="ui-hidden-accessible" for="edBNinfname">Förnamn:</label>
								<input placeholder="Förnamn" id="edBNinfname" name="edBNinfname" type="text">
							</li>
							<li>
								<label class="ui-hidden-accessible" for="edBNinlname">Efternamn:</label>
								<input placeholder="Efternamn" id="edBNinlname" name="edBNinlname" type="text">
							</li>
							<li data-role="fieldcontain">
								<fieldset  id="edBNinsexRadio" data-role="controlgroup" data-type="horizontal" >
									<label for="edBNinsexM">Male</label>
									<input type="radio" name="edBNinsex" id="edBNinsexM" value="M"/>
									<label for="edBNinsexF">Female</label>
									<input type="radio" name="edBNinsex" id="edBNinsexF" value="F"/>
								</fieldset>
							</li>
							<li data-role="fieldcontain">
								<label class="ui-hidden-accessible" for="edBNboardNum">Efternamn:</label>
								<input placeholder="Boardnum" id="edBNboardNum" name="edBNboardNum" type="text">
							</li>
						</ul>
						<button id="changePlayerBNButton" type="submit" data-icon="edit" href="#" data-theme="b">
							Make changes
						</button>
					</form>
				</div>
			</div>
			<div id="myDialog" data-role="popup" data-transition="pop">
				<div data-role="header">
					<h1>Remove from todays statistics?</h1>
				</div>
				<div data-role="content">
					<p>
						This action will remove the player(s) from todays statistics.
					</p>

					<a data-icon="delete" data-role="button" data-rel="back" data-theme="a">Cancel</a>
					<button id="allConfirm" data-icon="edit" href="#" data-theme="b">
						Remove player(s)
					</button>

				</div>
			</div>
			<div id="gameInfo" data-role="popup" data-transition="slidefade" data-theme="b" data-overlay-theme="a" class="ui-content">

				<h2>1 - rest</h2>
				<p>
					Focus on equal resting, when possible mixed sexes.
				</p>
				<h2>2 - same sex</h2>
				<p>
					Focus on equal resting, when possible same sexes.
				</p>
				<h2>3 - random</h2>
				<p>
					Mixed play, randomize partners.
				</p>

			</div>

		</div>

		<!-- --------------Matcher----------------- -->
		<div data-role="page" id="matcher">

			<div data-theme="a" data-role="header" data-id="persistent" data-position="fixed">
				<div data-role="navbar" data-iconpos="top">
					<ul>
						<li>
							<a  data-icon="gear" data-theme="a" href="index.php#admin">Settings</a>
						</li>
						<li>
							<a  data-icon="edit" data-theme="a"    href="index.php#prepp">Prep</a>
						</li>
						<li>
							<a class="ui-btn-active ui-state-persist" data-icon="grid" data-theme="a" href="index.php#matcher">Matches</a>
						</li>
						<li>
							<a  data-icon="star" data-theme="a" href="index.php#statistik">Statistics</a>
						</li>
					</ul>
				</div><!-- /navbar -->
			</div>

			<div data-role="content">

				<div id="matchContain" class="ui-grid-b matchBreak">

					<div class="ui-block-a matchBreak">
						<div class="timeExample" style="width: 100%; height: 180px;"></div>
						<div data-role="navbar">
							<ul>
								<li>
									<a href="#"  id="timeButtonStart">Start</a>
								</li>
								<li>
									<a href="#" id="timeButtonPause">Pause</a>
								</li>
								<li>
									<a href="#"  id="timeButtonRestart">Restart</a>
								</li>
							</ul>
						</div>
						<br>
						<a href="" data-role="button"  data-icon="back" id="resetButton">Reset pairings</a>
						<a href="" data-role="button"  id="resultButton">Report results</a>

						<div id="currentGames"></div>

					</div>
					<div id="currentResting" class="ui-block-b matchBreak">

						<ul id="restList" data-split-icon="star" data-role="listview" data-inset="true" data-divider-theme="a" data-theme="b">

						</ul>
					</div>
					<div id="playedRounds" class="ui-block-c matchBreak">

					</div>

				</div>

			</div><!-- /content matcher -->

			<div class="ui-bar-b" data-theme="a" data-role="footer"  data-id="persistent" data-position="fixed">

				<h4 class="sessionDisp"></h4>
			</div>

		</div><!-- /page matcher -->

		<!-- --------------Statistik----------------- -->
		<div data-role="page" id="statistik">

			<div data-theme="a" data-role="header" data-id="persistent" data-position="fixed">
				<div data-role="navbar" data-iconpos="top">
					<ul>
						<li>
							<a  data-icon="gear" data-theme="a" href="index.php#admin">Settings</a>
						</li>
						<li>
							<a  data-icon="edit" data-theme="a"   href="index.php#prepp">Prep</a>
						</li>
						<li>
							<a  data-icon="grid" data-theme="a" href="index.php#matcher">Matches</a>
						</li>
						<li>
							<a class="ui-btn-active ui-state-persist" data-icon="star" data-theme="a" href="index.php#statistik">Statistics</a>
						</li>
					</ul>
				</div><!-- /navbar -->
			</div>

			<div data-role="content">

				<div id="gridContainerRank" class="matchBreak ui-grid-b">
					<div id="gridRankLeft" class="ui-block-a">
						<div id="rankPeriods">
							<ul id="rankPeriodList" data-split-icon="star" data-role="listview" data-inset="true" data-divider-theme="a" data-theme="b"></ul>
						</div>
					</div>
					<div id="gridRankMiddle" class="ui-block-b">
						<ul  id="rankList" data-split-icon="star" data-role="listview" data-inset="true" data-divider-theme="a" data-theme="b"></ul>

					</div>
					<div id="gridRankRight" class="ui-block-c"></div>
				</div>
			</div><!-- /content -->

			<div class="ui-bar-b" data-theme="a" data-role="footer"  data-id="persistent" data-position="fixed">

				<h4 class="sessionDisp"></h4>
			</div>

		</div><!-- /page statistik -->

		<div id="editSession" data-role="page" data-transition="pop">
			<div data-role="header">
				<h1>Sessions</h1>
			</div>
			<div data-role="content">
				<a href="" id="newSessionLink" data-role="button">Create session</a>
				<br>
				<br>
				Choose session:
				<br>
				<div id="oldSessions"></div>
				<br>
				<br>
				<a data-icon="delete" href="#" data-role="button" data-rel="back" data-theme="a" id="sessionCancel">Cancel</a>
			</div>
		</div>
		<div id="customPairs" data-role="page" data-transition="pop">
			<div data-role="header">
				<h1>Make pairs</h1>
			</div>
			<div data-role="content">
				<div class="ui-grid-a">

					<div class="ui-block-a">
						<div id="numberOfGamesDiv">
							<br>
							<ul id="numberOfGames" data-role='listview'>

							</ul>
						</div>
					</div>
					<div id="pairContent" class="ui-block-b ui-grid-a">
						<div id="pairContentLeft" class="ui-block-a"></div>
						<div id="pairContentRight" class="ui-block-b"></div>
					</div>
				</div>

				<br>
				<br>
				<a data-icon="check" href="#" data-role="button" data-rel="back" data-theme="a">Done</a>
			</div>
		</div>
	</body>
</html>