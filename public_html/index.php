<?php

$title  = 'Тест для php-разработчиков';
$author = 'Fingli Group';
$date   = '2022';
?>
<!DOCTYPE html>
<html lang="ru" class="h-100">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $title ?></title>
	<link rel="icon" href="/favicon.ico" sizes="any">
	<link rel="icon" href="/favicon.svg" type="image/svg+xml">
	<meta name="robots" content="noindex" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body class="d-flex flex-column h-100 bg-light">
	<main class="flex-shrink-0">
		<div class="container">
			<h1 class="my-4"><?= $title ?></h1>
			<div class="alert alert-info my-4">
				<a href="https://fsa.gov.ru/" target="_blank">Федеральная служба по аккредитации</a>
			</div>
			<section class="card my-4">
				<h2 class="card-header">Поиск деклараций</h2>
				<div class="card-body">
					<form id="form-filter">
						<div class="mb-3">
							<label class="form-label" for="status">Статус</label>
							<select class="form-select" id="status" name="status" required>
								<option value="">- Любой -</option>
								<option value="6">- Действует -</option>
								<option value="20">- Черновик -</option>
								<option value="13">- Отправлен -</option>
								<option value="18">- Удалён -</option>
								<option value="14">- Прекращён -</option>
								<option value="15">- Приостановлен -</option>
								<option value="19">- Частично приостановлен -</option>
								<option value="3">- Возобновлён -</option>
								<option value="16">- Продлён -</option>
								<option value="1">- Архивный -</option>
								<option value="10">- Направлено уведомление о прекращении -</option>
								<option value="5">- Выдано предписание -</option>
								<option value="42">- Ожидает проверки оператора реестра -</option>
								<option value="11">- Выдано Недействителен -</option>
							</select>
						</div>
						<div class="mb-3">
							<label for="number">Номер соответствия</label>
							<input type="text" class="form-control" id="number" name="number" placeholder="">
						</div>

						<div class="mb-3">
							<p class="mt-2">дата регистрации декларации:</p>
							<div class="d-inline">
								<label for="start">с:</label>
								<input type="date" id="regDate_minDate" name="regDate_minDate" value="2022-11-03">
							</div>
							<div class="d-inline">
								<label for="finish">по:</label>
								<input type="date" id="regDate_maxDate" name="regDate_maxDate" value="2022-11-03">
							</div>

							<p class="mt-2">дата окончания действия декларации:</p>
							<div class="d-inline">
								<label for="start">с:</label>
								<input type="date" id="endDate_minDate" name="endDate_minDate" value="2022-11-03">
							</div>
							<div class="d-inline">
								<label for="finish">по:</label>
								<input type="date" id="endDate_maxDate" name="endDate_maxDate" value="2022-11-03">
							</div>
						</div>

						<div class="btn-group mb-3" role="group" aria-label="Basic radio toggle button group">
							<input type="radio" class="btn-check" name="size" value="25" id="btnradio1" autocomplete="off" checked>
							<label class="btn btn-outline-primary" for="btnradio1">25</label>

							<input type="radio" class="btn-check" name="size" value="50" id="btnradio2" autocomplete="off">
							<label class="btn btn-outline-primary" for="btnradio2">50</label>

							<input type="radio" class="btn-check" name="size" value="100" id="btnradio3" autocomplete="off">
							<label class="btn btn-outline-primary" for="btnradio3">100</label>
						</div>

						<div>
							<button class="btn btn-primary" id="submit-form-button" type="button">Найти</button>
						</div>
					</form>
				</div>
			</section>
			<section class="card my-4">
				<h2 class="card-header">Список деклараций</h2>
				<div class="card-body">
					<div class="table-responsive table-striped table-sm">
						<table id="declaration-list" class="table">
							<thead>
								<tr>
									<th data-field="id">id</th>
									<th data-field="statusName">Статус</th>
									<th data-field="number">Номер</th>
									<th data-field="registrationDate">Дата регистрации</th>
									<th data-field="endDate">Дата окончания действия</th>
									<th data-field="productName">Наименование продукции</th>
									<th data-field="applicantName">Заявитель</th>
									<th data-field="manufacterName">Изготовитель</th>
									<th data-field="productOrigin">Происхождение продукции</th>
									<th data-field="objectType">Тип объекта декларирования</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</section>
		</div>
	</main>
	<footer class="footer mt-auto py-3 bg-dark">
		<div class="container">
			<span class="text-muted"><?= "$date. $author" ?></span>
		</div>
	</footer>
	<script src="../js/jquery-3.6.1.min.js"></script>
	<script src="../ajax/ajax.js"></script>
</body>

</html>