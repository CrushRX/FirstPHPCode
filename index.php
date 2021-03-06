<?php
	//Вывод даты изменения последних файлов в папках 
	//ini_set('max_execution_time', 900); 
    ini_set('display_errors', 'Off'); 

	$Routes = array(
		"Название бригады 1" => "Путь до папки 1",
		"Название бригады 2" => "Путь до папки 2",
		"Название бригады 3" => "Путь до папки 3"
	);


	$Name = "Название подстанции";


	function getLastFile($routeDir) {
		$files = array_diff(scandir("$routeDir"), array('..', '.'));
		$biggest = "2.txt";
		rsort($files, SORT_NUMERIC);
		unset($files[0],$files[1]);
		rsort($files, SORT_NUMERIC);

		for($i = 0; $i < count($files); $i++)
		{
			if(filectime($routeDir.$biggest) < filectime($routeDir.$files[$i])) {
				$biggest = $files[$i];
			}

		}
		$dateFile = $routeDir.$biggest;
		return date("d.m.Y", filemtime($dateFile));
	}
?>

<table>
    <colgroup>
    <col span="2" style="background:Khaki">
    <col style="background-color:LightCyan">
    </colgroup>
<tr>
    <th>Подстанция</th>
    <th>Бригада</th>
    <th>Дата последней записи</th>
</tr>

<?php 
    foreach ($Routes as $key => $value) {
		echo "<tr><th>".$Name."</th><th>".key($Routes)."</th><th>".getLastFile($Routes[$key])."</th></tr>";
		next($Routes);
    }
?><br>
