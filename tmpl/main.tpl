<!DOCTYPE html>
<html>
<head>
	<title>Парикмахерская</title>
	<meta http-equiv="Content-type" content="text/html; charset=windows-1251">
	<link rel="stylesheet" href="css/front.css" type="text/css">
	<link type="image/x-icon" rel="shortcut icon" href="/favicon.ico" />
</head>
<body>
	<div id="wrapper">
		<div id="auth">
			<a href="http://dgma/test/?view=auth">Выход</a>
		</div>
		<div id="header">
			<h3>Парикмахерская</h3>
		</div>
		<form name="myform" action="functions.php" method="POST">
		<div id="content">
			<table border="1">
				<tr>
					<td valign="top">
						<table border="1">
							<tr>
								<td><a href="http://dgma/hairdressing/?view=">Заказы</a></td>
							</tr>                        
							<tr>                         
								<td><a href="http://dgma/hairdressing/?view=client">Клиенты</a></td>
							</tr>                        
							<tr>                         
								<td><a href="http://dgma/hairdressing/?view=worker">Работники</a></td>
							</tr>                        
							<tr>                         
								<td><a href="http://dgma/hairdressing/?view=service">Услуги</a></td>
							</tr>                        
							<tr>                         
								<td><a href="http://dgma/hairdressing/?view=consumables">Расходные<br/>материалы</a></td>
							</tr>                        
							<tr>                         
								<td><a href="http://dgma/hairdressing/?view=equipment">Оборудование</a></td>
							</tr>
							<tr>                         
								<td><input type="submit" class="report" name="report" value="Составить отчет"></td>
							</tr>
						</table>
					</td>
					<td>
						<h3 id="name2">%title%</h3>
						
							
							%middle%
							%form%
						
					</td>
				</tr>
			</table>
			
		</div>
		</form>
		<div id="footer"></div>
	</div>
</body>
</html>