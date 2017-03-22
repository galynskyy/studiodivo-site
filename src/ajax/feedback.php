<?php
	/* Check Data */
		if(empty($_POST["name"]) && empty($_POST["email"]) && empty($_POST["phone"])) {
			exit();
		}
	/* /Check Data */
	/* SQL */
		try {
			$conn = new PDO("mysql:host=localhost;dbname=base", "user", "password");
			$conn->exec("set names utf8");
		}
		catch (PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
		}

		$query = $conn->prepare("INSERT INTO feedback (name, email, phone, time) VALUES (:name, :email, :phone, :time)");
		$query->bindParam(":name", $_POST["name"], PDO::PARAM_STR, 18);
		$query->bindParam(":email", $_POST["email"], PDO::PARAM_STR, 18);
		$query->bindParam(":phone", $_POST["phone"], PDO::PARAM_STR, 18);
		$query->bindParam(":time", date("Y-m-d H:i:s"), PDO::PARAM_STR, 18);
		$query->execute();
		$result = $query->fetchColumn();
		
		
		if($query->rowCount() > 0)
		{
			$status = "Запись добавлена";
		}
		else
		{
			$status = "Запись не добавлена";
		}
		
		echo json_encode(array(
			"status" =>	$status
		));
	/* /SQL */

	/* Telegram */
		$TelegramKey = "key";
		$TelegramId1 = "id1";
		$TelegramId2 = "id2";
		$TelegramText = "Новая заявка:%0AИмя: ".$_POST["name"]."%0AEmail: ".$_POST["email"]."%0AТелефон: ".$_POST["phone"]."%0AДата/Время: ".date("Y-m-d H:i:s");

			$sendTelegram1 = file_get_contents("https://api.telegram.org/bot".$TelegramKey."/sendMessage?chat_id=".$TelegramId1."&text=".$TelegramText);
			$sendTelegram2 = file_get_contents("https://api.telegram.org/bot".$TelegramKey."/sendMessage?chat_id=".$TelegramId2."&text=".$TelegramText);
	/* /Telegram */
?>