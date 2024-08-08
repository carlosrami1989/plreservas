<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<h2>Fullscreen with JavaScript</h2>
<p>Click on the button to open the video in fullscreen mode.</p>
<button onclick="openFullscreen();">Open Video in Fullscreen Mode</button>
<p><strong>Tip:</strong> Press the "Esc" key to exit full screen.</p>

<video autoplay loop controls id="myvideo">
                                        <source
                                            src="/video/2.mp4"
                                            type="video/mp4"
                                        />
                                        Your browse
                                        r does not support the video
                                        tag.
                                    </video>
                                    
<script>
var elem = document.getElementById("myvideo");
function openFullscreen() {
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.webkitRequestFullscreen) { /* Safari */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE11 */
    elem.msRequestFullscreen();
  }
}
</script>
                                    
</body>
<script>

</html>
