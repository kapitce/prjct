<?php
	function  Password($number, $bglett, $smlett, $symbol, $lenght){
		$passn = array();

		$arrnumb = array('0','1','2','3','4','5','6','7','8','9');
		$arrbl = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'V', 'X', 'Y', 'Z', 'J','U','W');
		$arrsl = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'v', 'x', 'y', 'z', 'j','u','w');
		$arrsp = array('%', '*', '?', '@', '#', '$', '~');

		if($number == false && $bglett == false  && $smlett == false && $symbol == false){
			return 'Не выбраны настройки генератора!';
		}
		else{
			for ($n = 0; $n < 10; $n++){	
				$pass = '';
				$i = 0;
				while($i < $lenght){
					$a = rand(1,4);
					if ($a == 1 && $number == true){
						$r = rand(0,9);
						$pass = $pass.$arrnumb[$r];
						$i++;
					}
					if ($a == 2 && $bglett == true){
						$r = rand(0,25);
						$pass = $pass.$arrbl[$r];
						$i++;
					}
					if ($a == 3 && $smlett == true){
						$r = rand(0,25);
						$pass = $pass.$arrsl[$r];
						$i++;
					}
					if ($a == 4 && $symbol == true){
						$r = rand(0,6);
						$pass = $pass.$arrsp[$r];
						$i++;
					}
				}
				array_push($passn, $pass);
			}

			return $passn;
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Случайный пароль</title>
</head>
<body>
	<form method="post">
		<h1>Генератор паролей</h1>
		Настройка генератора: <br>
		<input type="checkbox" name="number" value='Цифры'
		<?php if(isset($_POST['number'])) echo 'checked';?>
		> Цифры <br>
		<input type="checkbox" name="bglett" value='Прописные'
		<?php if(isset($_POST['bglett'])) echo 'checked';?>
		> Прописные буквы <br>
		<input type="checkbox" name="smlett" value='Строчные'
		<?php if(isset($_POST['smlett'])) echo 'checked';?>
		> Строчные буквы <br>
		<input type="checkbox" name="symbol" value='Символы'
		<?php if(isset($_POST['symbol'])) echo 'checked';?>
		> Специальные символы (%, *, ?, @, #, $, ~) <br>
		Длина пароля: <input type="number" name="lenght" required value=
		<?php if(isset($_POST['lenght'])){
			echo $_POST['lenght'];
			}else{
				echo 6;
			}?>
		min=6 max=12> <br>
		<input type="submit" name="button" value='Создать пароль'>
	</form>
	<?php 
		$lenght = $_POST['lenght'];

		if(isset($_POST['number'])){
			$number = true;
		}else{
			$number = false;
		}

		if(isset($_POST['bglett'])){
			$bglett = true;
		}else{
			$bglett = false;
		}

		if(isset($_POST['smlett'])){
			$smlett = true;
		}else{
			$smlett = false;
		}

		if(isset($_POST['symbol'])){
			$symbol = true;
		}
		else{
			$symbol = false;
		}

		if (isset($_POST['button'])){
			$a = password($number, $bglett, $smlett, $symbol,$lenght);
			
			if(gettype($a) == 'string'){
				echo $a;
			}else{
				$i = 0;
				for ($n = 0; $n < 10; $n++){
					echo $a[$n].' ';
					$i++;
					if($i == 5){
						echo "<br>";
					}
				}
			}
		}
	?>
</body>
</html>