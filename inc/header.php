<!DOCTYPE html>
<HTML>
<head>
	<title>Gas Logbook Demo</title>
	<script src='<?= JS_PATH . 'jquery-3.2.1.min.js'?>'></script>
	<script src='//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js'></script>
	<script src='<?= JS_PATH .'scripts.js?v=' . md5_file(JS_PATH . 'scripts.js')?>'></script>
	
	<!-- Reset css -->
	<link href='<?= CSS_PATH . 'reset.css?v=' . md5_file(CSS_PATH . 'reset.css')?>' rel='stylesheet' type='text/css'>
	
	<link href='https://fonts.googleapis.com/css?family=Chakra+Petch|Lato|Spartan|Abel&display=swap' rel='stylesheet'>
	<link href='//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css' rel='stylesheet'>
	<link href='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css' rel='stylesheet'>
	<link href='<?= CSS_PATH . 'styles.css?v=' . md5_file(CSS_PATH . 'styles.css')?>' rel='stylesheet' type='text/css'>
	
	<!-- DataTables -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/b-1.6.3/b-flash-1.6.3/b-html5-1.6.3/b-print-1.6.3/fh-3.1.7/datatables.min.css"/> 
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/b-1.6.3/b-flash-1.6.3/b-html5-1.6.3/b-print-1.6.3/fh-3.1.7/datatables.min.js"></script>
	
	<!-- Charts JS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css" integrity="sha512-SUJFImtiT87gVCOXl3aGC00zfDl6ggYAw5+oheJvRJ8KBXZrr/TMISSdVJ5bBarbQDRC2pR5Kto3xTR0kpZInA==" crossorigin="anonymous" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>
	
</head>