<?php
include_once("connect.php");

// MySQL 서버 연결 정보
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "mandmz";

// MySQL 서버에 연결
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("MySQL 서버 연결 실패: " . $conn->connect_error);
}

// 모든 음악 데이터를 가져오는 SQL 쿼리
$sql = "SELECT * FROM music";

// 쿼리를 실행하고 결과를 가져옴
$result = $conn->query($sql);

// 결과가 존재하는지 확인
if ($result->num_rows > 0) {
    // 각 결과의 행을 반복하면서 음악 데이터를 표시하는 HTML 요소를 생성
    while ($row = $result->fetch_assoc()) {
        $title = $row['title'];
        $artist = $row['artist'];
        $audio = $row['file_path'];
        $image = $row['album'];

        // 음악 데이터를 표시하는 HTML 코드를 생성
        $musicElement = '
            <div class="result">
                <div class="image">
                    <img src="data:image/jpeg;base64,' . base64_encode($image) . '" alt="">
                </div>
                <span class="musicTitle">' . $title . '</span>
                <div class="icons">
                    <div class="play">
                        <i class="fa-solid fa-play fa-xl" style="color: #2b2b2b;"></i>
                    </div>
                    <div class="pause">
                        <i class="fa-solid fa-pause fa-xl" style="color: #2b2b2b;"></i>
                    </div>
                    <a href="write.html" class="write">
                        <i class="fa-regular fa-pen-to-square fa-xl" style="color: #2b2b2b;"></i>
                    </a>
                </div>
                <span class="musicSinger">' . $artist . '</span>
                
                <!-- 음악 재생 -->
                <audio src="' . $audio . '"></audio>
            </div>';

        // 모든 음악 데이터를 표시하는 HTML 코드를 출력
        echo $musicElement;
    }
} else {
    // 결과가 없을 경우 메시지를 표시
    echo "음악 데이터가 없습니다.";
}

// MySQL 서버 연결을 닫기
$conn->close();
?>