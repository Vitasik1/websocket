<!DOCTYPE html>
<html>

<head>
	<title>Chat</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<style type="text/css">
		#messages {
			height: 200px;
			background: whitesmoke;
			overflow: auto;
		}

		#chat-room-frm {
			margin-top: 10px;
		}
	</style>
</head>

<body>
	<div class="container">
		<h2 class="text-center" style="margin-top: 5px; padding-top: 0;">Chat room</h2>
		<hr>
		<div class="row">
			<div class="col-md-4">
				<?php
				session_start();
				if (!isset($_SESSION['user'])) {
					header("location: index.php");
				}
				require("db/users.php");
				require("db/chatrooms.php");

				$objChatroom = new chatrooms;
				$chatrooms = $objChatroom->getAllChatRooms();

				$objUser = new users;
				$users = $objUser->getAllUsers();
				?>
				<table class="table table-striped">
					<thead>
						<tr>
							<td>
								<?php
								foreach ($_SESSION['user'] as $key => $user) {
									$userId = $key;
									echo '<input type="hidden" name="userId" id="userId" value="' . $key . '">';
									echo "<div>" . $user['name'] . "</div>";
									echo "<div>" . $user['email'] . "</div>";
								}
								?>
							</td>
							<td align="right" colspan="2">
								<input type="button" class="btn btn-warning" id="leave-chat" name="leave-chat"
									value="Leave">
							</td>
						</tr>
						<tr>
							<th colspan="3">Users</th>
						</tr>
					</thead>
					<table id="usersTable">

                      
					</table>
				</table>
				<script>
					setInterval(function () {
						// Виконати AJAX-запит
						var xhttp = new XMLHttpRequest();
						xhttp.onreadystatechange = function () {
							if (this.readyState == 4 && this.status == 200) {
								document.getElementById("usersTable").innerHTML = this.responseText;
							}
						};
						xhttp.open("GET", "update_users.php", true);
						xhttp.send();
					}, 1000); 
				</script>

			</div>
			<div class="col-md-8">
				<div id="messages">
					<table id="chats" class="table table-striped">
						<thead>
							<tr>
								<th colspan="4" scope="col"><strong>Chat Room</strong></th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($chatrooms as $key => $chatroom) {

								if ($userId == $chatroom['userid']) {
									$from = "Me";
								} else {
									$from = $chatroom['name'];
								}
								echo '<tr><td valign="top"><div><strong>' . $from . '</strong></div><div>' . $chatroom['msg'] . '</div><td align="right" valign="top">' . date("d/m/Y h:i:s A", strtotime($chatroom['created_on'])) . '</td></tr>';
							}
							?>
						</tbody>
					</table>
				</div>

				<form id="chat-room-frm" method="post" action="">
					<div class="form-group">
						<textarea class="form-control" id="msg" name="msg" placeholder="Enter Message"></textarea>
					</div>
					<div class="form-group">
						<input type="button" value="Send" class="btn btn-success btn-block" id="send" name="send">
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function () {
		var conn = new WebSocket('ws://localhost:8080');
		conn.onopen = function (e) {
			console.log("Connection established!");
		};

		conn.onmessage = function (e) {
			console.log(e.data);
			var data = JSON.parse(e.data);
			var row = '<tr><td valign="top"><div><strong>' + data.from + '</strong></div><div>' + data.msg + '</div><td align="right" valign="top">' + data.dt + '</td></tr>';
			$('#chats > tbody').prepend(row);

		};

		conn.onclose = function (e) {
			console.log("Connection Closed!");
		}

		$("#send").click(function () {
			var userId = $("#userId").val();
			var msg = $("#msg").val();
			var data = {
				userId: userId,
				msg: msg
			};
			conn.send(JSON.stringify(data));
			$("#msg").val("");
		});

		$("#leave-chat").click(function () {
			var userId = $("#userId").val();
			$.ajax({
				url: "action.php",
				method: "post",
				data: "userId=" + userId + "&action=leave"
			}).done(function (result) {
				var data = JSON.parse(result);
				if (data.status == 1) {
					conn.close();
					location = "index.php";
				} else {
					console.log(data.msg);
				}

			});

		})

	})
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
	integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
	crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
	integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
	crossorigin="anonymous"></script>

</html>