<?php

require_once 'DB.php';

$db = (new DB("data.db"))->db;

$sthMatches = $db->prepare("CREATE TABLE IF NOT EXISTS matches (
	matchId VARCHAR(16) PRIMARY KEY,
	eventId VARCHAR(8),
	blueScore SMALLINT,
	blueTeam1 VARCHAR(7),
	blueTeam2 VARCHAR(7),
	blueTeam3 VARCHAR(7),
	redScore SMALLINT,
	redTeam1 VARCHAR(7),
	redTeam2 VARCHAR(7),
	redTeam3 VARCHAR(7),
	lastUpdated INTEGER DEFAULT CURRENT_TIMESTAMP
)");

$sthMatches->execute();

$sthEvents = $db->prepare("CREATE TABLE IF NOT EXISTS events (
	eventId VARCHAR(8) PRIMARY KEY,
	name VARCHAR(128),
	lastUpdated INTEGER DEFAULT CURRENT_TIMESTAMP
)");

$sthEvents->execute();

$sthTeams = $db->prepare("CREATE TABLE IF NOT EXISTS teams (
	teamId VARCHAR(7) PRIMARY KEY,
	nickname VARCHAR(64),
	events TEXT,
	lastUpdated INTEGER DEFAULT CURRENT_TIMESTAMP
)"); // Events column will have pipe delimited list

$sthTeams->execute();

$sthTeamEventDetails = $db->prepare("CREATE TABLE IF NOT EXISTS teamEventDetails (
	teamId VARCHAR(7),
	eventId VARCHAR(8),
	rank SMALLINT,
	qualAvg SMALLINT,
	auton SMALLINT,
	container SMALLINT,
	coopertition SMALLINT,
	litter SMALLINT,
	tote SMALLINT,
	matchesPlayed SMALLINT,
	opr DOUBLE,
	dpr DOUBLE,
	ccwm DOUBLE,
	lastUpdated INTEGER DEFAULT CURRENT_TIMESTAMP
)");

$sthTeamEventDetails->execute();

$sthAlliances = $db->prepare("CREATE TABLE IF NOT EXISTS alliances (
	seed TINYINT,
	eventId VARCHAR(8),
	team1Id VARCHAR(7),
	team2Id VARCHAR(7),
	team3Id VARCHAR(7),
	lastUpdated INTEGER DEFAULT CURRENT_TIMESTAMP
)");

$sthAlliances->execute();

$sthUsers = $db->prepare("CREATE TABLE IF NOT EXISTS users (
	userId INTEGER PRIMARY KEY AUTOINCREMENT,
	username VARCHAR(32),
	password VARCHAR(64),
	name VARCHAR(32)
)");

$sthUsers->execute();

$sthComments = $db->prepare("CREATE TABLE IF NOT EXISTS comments (
	commentId INTEGER PRIMARY KEY AUTOINCREMENT,
	userId INTEGER,
	notes TEXT,
	timePosted INTEGER DEFAULT CURRENT_TIMESTAMP
)");

$sthComments->execute();