<?php
function get_CURL($url) 
{
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  $result = curl_exec($curl);
  curl_close($curl);
  
  return json_decode($result, true);
}


$result = get_CURL('https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=UCWme0IpQvwDicdxGqx2AcxQ&key=AIzaSyCpjz5Vu_-ibNAtPJM1wDftHXIkOmILchU');

$youtubeProfilPic = $result['items'][0]['snippet']['thumbnails']['medium']['url'];
$channelName = $result['items'][0]['snippet']['title'];
$subscriber = $result['items'][0]['statistics']['subscriberCount'];

// latest video
$urlLatestVideo = 'https://www.googleapis.com/youtube/v3/search?key=AIzaSyCpjz5Vu_-ibNAtPJM1wDftHXIkOmILchU&channelId=UCWme0IpQvwDicdxGqx2AcxQ&maxResults=1&order=date&part=snippet';
$result = get_CURL($urlLatestVideo);
$latestVideoId = $result['items'][0]['id']['videoId'];


// instagram API
$result = get_CURL('https://graph.instagram.com/v22.0/me?fields=username,profile_picture_url,followers_count&access_token=IGAAcmU45YhGpBZAFBMWVM5dHBTTHVRRUFiZA2p4ZA0daTmp5Rmp0WXZAKMngwTUl2bVluY3c2aThTVlREbXRDbVl4Mnk4OVcyN3lFeFFGbk1TWkNIN3JHanR5YzRUU1drNGxEVUQwTXQwLWp4RzVIanFXWWlKSVNtSnBJc05oWU9HbwZDZD');
$userNameIG = $result['username'];
$profilePictureIG = $result['profile_picture_url'];
$followersIG = $result['followers_count'];


//latest ig post
$result = get_CURL('https://graph.instagram.com/me/media?fields=id,caption,media_type,media_url,timestamp&access_token=IGAAcmU45YhGpBZAFBMWVM5dHBTTHVRRUFiZA2p4ZA0daTmp5Rmp0WXZAKMngwTUl2bVluY3c2aThTVlREbXRDbVl4Mnk4OVcyN3lFeFFGbk1TWkNIN3JHanR5YzRUU1drNGxEVUQwTXQwLWp4RzVIanFXWWlKSVNtSnBJc05oWU9HbwZDZD&limit=6');

$photos = [];
foreach($result['data'] as $photo) {
  $photos[] = $photo['media_url'];
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- My CSS -->
    <link rel="stylesheet" href="css/style.css?v=1">

    <title>My Portfolio</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#home">Dwi Egil Radhiatur</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#portfolio">Portfolio</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>


    <div class="jumbotron" id="home">
      <div class="container">
        <div class="text-center">
         <img src="img/eji.jpeg" class="rounded-circle img-thumbnail" style="width: 300px; height: 300px; object-fit: cover;">
          <h1 class="display-4">Dwi Egil Radhiatur</h1>
          <h3 class="lead">Mahasiswa UIN Imam Bonjol Padang</h3>
        </div>
      </div>
    </div>


    <!-- About -->
    <section class="about" id="about">
      <div class="container">
        <div class="row mb-4">
          <div class="col text-center">
            <h2>About</h2>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-5">
            <p>maunya sih jadi orang dewasa yang keren, tapi nyatanya sering kebingungan mau makan apa. hidup ini kayak drama korea, kadang bikin baper, kadang bikin pengen ketawa ketiwi sendiri.</p>
          </div>
          <div class="col-md-5">
            <p>pengen hidup bebas tanpa beban, tapi nyatanya tiap hari dibebanin tugas sama perut yang selalu laper. ahli banget buat ngeles waktu diminta kerjaan, tapi pas diminta jajan? langsung semangat 45.</p>
          </div>
        </div>
      </div>
    </section>


<!-- Youtube & instagram -->
    <section class="social bg-light" id="social">
      <div class="container">
        <div class="row pt-4 mb-4">
          <div class="col text-center">
            <h2>Social Media</h2>
          </div>
        </div>

      <div class="row justify-content-center">
        <!-- kolom pertama -->
        <div class="col-md-5">
          <div class="row">
            <div class="col-md-4">
              <img src="<?= $youtubeProfilPic; ?>" width="200" class="rounded-circle img-thumbnail">
            </div>
            <div class="col-md-8">
              <h5><?= $channelName; ?></h5>
              <p><?= $subscriber; ?> Subscribers.</p>
              <div class="g-ytsubscribe" data-channelid="UCWme0IpQvwDicdxGqx2AcxQ" data-layout="default" data-count="hidden"></div>
            </div>
          </div>
          <div class="row mt-3 pb-3">
            <div class="col">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item"
                  src="https://www.youtube.com/embed/<?= $latestVideoId; ?>?rel=0"
                  allowfullscreen></iframe>
              </div>
            </div>
          </div>
        </div>

        <!-- kolom kedua -->
        <div class="col-md-5">
          <div class="row">
            <div class="col-md-4">
              <img src="<?= $profilePictureIG; ?>" width="200" class="rounded-circle img-thumbnail">
            </div>
            <div class="col-md-8">
              <h5><?= $userNameIG; ?></h5>
              <p><?= $followersIG;?> Followers.</p>
            </div>
          </div>
          <div class="row mt-3 pb-3">
            <div class="col ig-gallery">
                <?php foreach( $photos as $photo) : ?>
                <div class="ig-thumbnail">
                  <img src="<?= $photo; ?>">
                </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    
    <!-- Portfolio -->
    <section class="portfolio" id="portfolio">
      <div class="container">
        <div class="row pt-4 mb-4">
          <div class="col text-center">
            <h2>Portfolio</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/11.jpeg" alt="Card image cap">
              <div class="card-body">
               <p class="card-text"><strong>penunda profesional:</strong> spesialis nunda kerjaan sampe deadline tinggal 3 menit. skill: panik tapi produktif.</p>
              </div>
            </div>
          </div>

          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/12.jpeg" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">bisa kerja di bawah tekanan, seperti tekanan hidup dan pertanyaan 'kapan lulus?'</p>
              </div>
            </div>
          </div>

          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/14.jpeg" alt="Card image cap" style="width: 350px; height: 350px; object-fit: cover;">
              <div class="card-body">
                <p class="card-text"><strong>fast learner:</strong> bisa ngerti materi dalam 5 menit (setelah 5 jam breakdown).</p>
              </div>
            </div>
          </div>   
        </div>

        <div class="row">
          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/15.jpeg" alt="Card image cap">
              <div class="card-body">
                <p class="card-text"><strong>hacker perasaan:</strong> jago ngartiin chat "ok" jadi 12 makna berbeda dalam waktu 2 detik.</p>
              </div>
            </div>
          </div> 
          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/13.jpeg" alt="Card image cap" style="width: 350px; height: 460px; object-fit: cover;">
              <div class="card-body">
                <p class="card-text"><strong>overthinker kreatif:</strong> bisa bikin 3 plot film dari satu senyuman orang asing.</p>
                </p>
              </div>
            </div>
          </div>

          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/16.jpeg" alt="Card image cap">
              <div class="card-body">
                <p class="card-text"><strong>penulis skenario kehidupan yang tidak terjadi:</strong> imajinasi terlalu aktif, kadang bingung mana yang beneran kejadian.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- Contact -->
    <section class="contact bg-light" id="contact">
      <div class="container">
        <div class="row pt-4 mb-4">
          <div class="col text-center">
            <h2>Contact</h2>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-4">
            <div class="card bg-primary text-white mb-4 text-center">
              <div class="card-body">
                <h5 class="card-title">Contact Me</h5>
                <p class="card-text">Jika ada yang ingin ditanyakan silahkan hubungi aku.</p>
              </div>
            </div>
            
            <ul class="list-group mb-4">
              <li class="list-group-item"><h3>Location</h3></li>
              <li class="list-group-item">My Home</li>
              <li class="list-group-item">Jl. Patah Hati</li>
              <li class="list-group-item">West Sumatera, Indonesia</li>
            </ul>
          </div>

          <div class="col-lg-6">
            
            <form>
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email">
              </div>
              <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" class="form-control" id="phone">
              </div>
              <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" rows="3"></textarea>
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-primary">Send Message</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </section>


    <!-- footer -->
    <footer class="bg-dark text-white mt-5">
      <div class="container">
        <div class="row">
          <div class="col text-center">
            <p>Copyright &copy; 2018.</p>
          </div>
        </div>
      </div>
    </footer>







    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="https://apis.google.com/js/platform.js"></script>
  </body>
</html>