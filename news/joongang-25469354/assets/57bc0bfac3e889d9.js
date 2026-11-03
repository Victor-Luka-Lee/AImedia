// Read from json
var adUrl;
var debug = false;
var imaSdkUrl;
var videoJSCssUrl;
var videoJSJsUrl;
var videoPlayerWrapperId;
var videoUrl;
var videoType;
var videoPlayerLogo;
var videoPlayerLogoOnAd = false;
var videoPlayerFullscreen = false;
var videoPlayerMuted;
var videoPlayerSticky;
var videoSources = [];
var videoSourcesLength = 0;
var videoSourceIndex = 0;
var videoPlayerStickyThreshold = 0.5;
var videoPlayerStickyWidth = '256px';
var videoPlayerStickyHeight = '144px';
var videoPlayerStickyZIndex = "1";
var videoPlayerStickyRight = "20px";
var videoPlayerStickyBottom = "50px";
var imaContainerZIndex = 8;
var logoZIndex = 9;

// Global variables
var admaruPlayer;
var observer;
var playerDivIdName = "admaruPlayerDiv";
var playerId = "admaruPlayerID";
var userClose = false;
var imaScriptLoaded = false;
var videojsStyleLoaded = false;
var videojsScriptLoaded = false;
var videoStartingObserver;
var acvConditionSatisfied = false;

function beResponsiveUi() {
  debugMessage('beResponsiveUi');
  const videoPlayerWrapper = document.getElementById(videoPlayerWrapperId);
  if (!videoPlayerWrapper) return;
  const parentWidth = videoPlayerWrapper.parentElement.offsetWidth;
  videoPlayerWrapper.style.maxWidth = parentWidth + 'px';
  videoPlayerWrapper.style.maxHeight = (9 / 16 * parentWidth) + 'px';
}

window.visualViewport.addEventListener('resize', function () {
  beResponsiveUi();
});

function handleVideo(original) {
  debugMessage('handleVideo - original : ' + original);
  const playerDiv = document.getElementById(playerDivIdName);
  const playerControlBar = document.querySelector(".vjs-control-bar");
  if (!playerControlBar) debugMessage('playerControlBar is null');

  const closeButton = document.getElementById(playerId + "CloseButton");
  if (!closeButton) debugMessage('closeButton is null');

  if (original) {
    playerDiv.classList.remove("sticky");

    playerDiv.style.width = "100%";
    playerDiv.style.height = "100%";
    playerDiv.style.zIndex = "auto";
    playerDiv.style.right = "auto";
    playerDiv.style.bottom = "auto";

    if (closeButton) {
      closeButton.style.display = "none";
      closeButton.style.zIndex = "auto";
    }
  } else {
    playerDiv.classList.add("sticky");

    playerDiv.style.width = videoPlayerStickyWidth;
    playerDiv.style.height = videoPlayerStickyHeight;
    playerDiv.style.zIndex = videoPlayerStickyZIndex;
    playerDiv.style.right = videoPlayerStickyRight;
    playerDiv.style.bottom = videoPlayerStickyBottom;

    if (closeButton) {
      closeButton.style.display = 'block';
      closeButton.style.zIndex = videoPlayerStickyZIndex;
    }
  }
}

function disconnectObserver() {
  if (observer) observer.disconnect();
}

function initPlayerSticky() {
  disconnectObserver();

  const videoPlayerWrapper = document.getElementById(videoPlayerWrapperId);

  observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      handleVideo(entry.isIntersecting);
    });
  }, { threshold: videoPlayerStickyThreshold });

  observer.observe(videoPlayerWrapper);
}

function addCloseButton(player) {
  const closeButton = document.createElement('button');

  closeButton.classList.add('vjs-close-button');
  closeButton.classList.add("top-right");
  closeButton.id = playerId + "CloseButton";
  closeButton.addEventListener('click', function () {
    console.log('close button is clicked');
    userClose = true;
    disconnectObserver();
    handleVideo(true);
    // player.pause();
  });

  closeButton.style.display = 'none';
  player.el().appendChild(closeButton);
}

function getVideoSourceIndex() {
  return videoSourceIndex++ % videoSourcesLength;
}

function setVideoSource(player) {
  const index = getVideoSourceIndex();
  debugMessage("setVideoSource - index : " + index);
  const videoType = videoSources[index].videoType;
  debugMessage("setVideoSource - type : " + videoType);
  let videoSrc = videoSources[index].videoUrl;

  if (videoType === "video/mp4") {
    const h265Support = player.canPlayType('video/mp4; codecs="hev1.1.6.L93.90"');
    debugMessage("setVideoSource - h265Support : " + h265Support);
    if (h265Support !== "probably") {
      videoSrc = videoSources[index].fallbackUrl;
    }
  }

  debugMessage("setVideoSource - src : " + videoSrc);
  player.src({
    type: videoType,
    src: videoSrc
  });
}

function observeForInitialization(player) {
  debugMessage('observeForInitialization');
  acvConditionSatisfied = false;
  const videoPlayerWrapper = document.getElementById(videoPlayerWrapperId);

  videoStartingObserver = new IntersectionObserver(function (entries) {
    let step;
    const entryLength = entries.length;
    for (step = 0; step < entryLength; step++) {
      if (entries[step].isIntersecting) {
        debugMessage('observeForInitialization - play video');
        acvConditionSatisfied = true;
        playVideoAutomatically(admaruPlayer);
        break;
      }
    }
  }, { threshold: 0.5 });

  videoStartingObserver.observe(videoPlayerWrapper);
}

function initVideoJS() {
  const options = {
    controls: true,
    controlBar: {
      fullscreenToggle: videoPlayerFullscreen,
      pictureInPictureToggle: false,
    },
    disablePictureInPicture: true,
    // bigPlayButton: false,
  };

  admaruPlayer = videojs(playerId, options, function onPlayerReady() {
    debugMessage('Admaru player is ready.');

    // Mute will affect auto play.
    admaruPlayer.muted(videoPlayerMuted);

    setVideoSource(admaruPlayer);

    // Automatic video play only happens on mute
    if (videoPlayerMuted) observeForInitialization(admaruPlayer);
  });

  addCloseButton(admaruPlayer);

  if (videoPlayerLogo) admaruPlayer.logo(videoPlayerLogo);

  admaruPlayer.ima(
    {
      id: playerId,
      adTagUrl: adUrl,
      adsManagerLoadedCallback: function () {
        debugMessage('adsManagerLoadedCallback');
        if (videoPlayerLogoOnAd) handleAdsEvent(admaruPlayer);
        document.querySelector("#" + playerId + "_ima-ad-container").style.zIndex = imaContainerZIndex
      },
    }
  );

  handleVideoEvent(admaruPlayer);
}

function setLogoZIndex(zIndex) {
  const logoDivElement = document.querySelector(".vjs-logo-content");
  debugMessage('logoDivElement : ' + logoDivElement);
  if (logoDivElement) logoDivElement.style.zIndex = zIndex;
}

function handleAdsEvent(player) {
  player.ima.addEventListener(
    google.ima.AdEvent.Type.STARTED,
    function (event) {
      debugMessage('Ad event: ' + event.type);
      setLogoZIndex(logoZIndex);
    }
  );

  player.ima.addEventListener(
    google.ima.AdEvent.Type.COMPLETE,
    function (event) {
      debugMessage('Ad event: ' + event.type);
      setLogoZIndex("auto");
    }
  );
}

function playVideoAutomatically(player) {
  let promise = player.play();
  if (promise !== undefined) {
    promise.then(function () {
      // Autoplay started!
      debugMessage('Autoplay started.');
    }).catch(function (error) {
      debugMessage('Autoplay was prevented.');
    });
  }
}

function handleVideoEvent(player) {
  let midrollTime = 1000.0;
  // TODO: Set midrollTime dynamically
  const midrollInterval = 30;

  player.on("play", function () {
    if (videoStartingObserver) videoStartingObserver.disconnect();
    debugMessage('play - userClose : ' + userClose);
    debugMessage('play - videoPlayerSticky : ' + videoPlayerSticky);
    if (!userClose && videoPlayerSticky) initPlayerSticky();
  });

  player.on("pause", function () {
    debugMessage('pause');
  });

  player.on("adserror", function () {
    if (acvConditionSatisfied && player.paused()) {
      debugMessage('adserror');
      playVideoAutomatically(player);
    }
  });

  player.on("loadeddata", function () {
    debugMessage('loadeddata - player.duration() : ' + player.duration());
    // TODO: Set midrollTime dynamically
    if (!isNaN(player.duration())) midrollTime = midrollInterval;
    debugMessage('loadeddata - midrollTime : ' + midrollTime);
  });

  player.on("timeupdate", function () {
    const curr = player.currentTime();
    if (curr > midrollTime) {
      debugMessage('midroll ad start');
      // TODO: Set midrollTime dynamically
      midrollTime = midrollTime + midrollInterval;

      callACV(function (videoAdUrl) {
        debugMessage('callACV - videoAdUrl : ' + videoAdUrl);
        if (videoAdUrl) this.adUrl = videoAdUrl;

        requestControlledAd(player, adUrl);
        player.currentTime(curr);
      });
    }
  });

  player.on('ended', function () {
    debugMessage('Admaru player is ended.');
    // Set next video
    setVideoSource(player);
    // Set Ad
    callACV(function (videoAdUrl) {
      debugMessage('callACV - videoAdUrl : ' + videoAdUrl);
      if (videoAdUrl) this.adUrl = videoAdUrl;

      requestControlledAd(player, adUrl);
      // Play video automatically
      playVideoAutomatically(player);
    });
  });

  player.on('contextmenu', function (event) {
    debugMessage('Admaru player contextmenu is called.');
    event.preventDefault();
  });

  player.on('dispose', function () {
    debugMessage('Admaru player is disposed.');
    // Nothing seems controllable on dispose.
    // Let's do not use player.dispose() for now.
  });
}

function requestControlledAd(player, adTagUrl) {
  player.ima.initializeAdDisplayContainer();
  player.ima.setContentWithAdTag(null, adTagUrl, true);
  player.ima.requestAds();
}

function artifactLoaded() {
  if (imaScriptLoaded && videojsStyleLoaded && videojsScriptLoaded) {
    debugMessage('all artifacts loaded');
    initVideoJS();
  }
}

// Function to create and append the video player
function createVideoPlayerDiv() {
  const videoPlayerWrapper = document.getElementById(videoPlayerWrapperId);
  if (!videoPlayerWrapper) {
    console.error('Please set PlayerWrapperId correctly');
    return;
  }

  // For wrapper div to have responsive UI
  beResponsiveUi();

  // Create player div
  const playerDiv = document.createElement("div");
  playerDiv.style = "display: block; width:100%; height:100%; visibility: visible; background: white;";
  playerDiv.id = playerDivIdName;
  playerDiv.className = playerDivIdName;

  // Create video element
  const videoElement = document.createElement("video");
  videoElement.style = "display: block; width:100%; height:100%; visibility: visible; background: white; top: 0px; left: 0px;";
  videoElement.id = playerId;
  videoElement.className = "video-js vjs-default-skin";
  videoElement.preload = "auto";
  // videoElement.poster = "//vjs.zencdn.net/v/oceans.png";
  if (navigator.userAgent.toLowerCase().indexOf("iphone") > -1) {
    debugMessage('iPhone');
    videoElement.setAttribute("playsinline", "");
  }

  // Append video element to player div
  playerDiv.appendChild(videoElement);

  // Append IMA HTML5 SDK script
  const imaScript = document.createElement("script");
  imaScript.type = "text/javascript";
  imaScript.src = imaSdkUrl;
  imaScript.onload = function () {
    debugMessage('imaScript loaded');
    imaScriptLoaded = true;
    artifactLoaded();
  }
  imaScript.onerror = function (event) {
    debugMessage('imaScript loading error probably due to adblock');
    videoPlayerWrapper.style.display = "none";
  }
  playerDiv.appendChild(imaScript);

  // Append Video.js styles
  const videoJsStylesheet = document.createElement("link");
  videoJsStylesheet.rel = "stylesheet";
  videoJsStylesheet.type = "text/css";
  videoJsStylesheet.href = videoJSCssUrl;
  videoJsStylesheet.onload = function () {
    debugMessage('videoJsStylesheet loaded');
    videojsStyleLoaded = true;
    artifactLoaded();
  }
  playerDiv.appendChild(videoJsStylesheet);

  // Append Video.js script
  const videoJsScript = document.createElement("script");
  videoJsScript.src = videoJSJsUrl;
  videoJsScript.onload = function () {
    debugMessage('videoJsScript loaded');
    videojsScriptLoaded = true;
    artifactLoaded();
  }
  playerDiv.appendChild(videoJsScript);

  // Append player to wrapper
  videoPlayerWrapper.appendChild(playerDiv);
}

function logFetchedJSONData() {
  debugMessage("adUrl : " + adUrl);
  debugMessage("videoPlayerLogo : " + videoPlayerLogo);
  debugMessage("videoPlayerLogoOnAd : " + videoPlayerLogoOnAd);
  debugMessage("videoPlayerFullscreen : " + videoPlayerFullscreen);
  debugMessage("videoPlayerMuted : " + videoPlayerMuted);
  debugMessage("videoPlayerSticky : " + videoPlayerSticky);
  debugMessage("videoSources : " + JSON.stringify(videoSources));
  debugMessage("videoPlayerWrapperId : " + videoPlayerWrapperId);
  debugMessage("videoSourcesLength : " + videoSourcesLength);
  debugMessage("videoPlayerStickyThreshold : " + videoPlayerStickyThreshold);
  debugMessage("videoPlayerStickyWidth : " + videoPlayerStickyWidth);
  debugMessage("videoPlayerStickyHeight : " + videoPlayerStickyHeight);
  debugMessage("videoPlayerStickyZIndex : " + videoPlayerStickyZIndex);
  debugMessage("videoPlayerStickyRight : " + videoPlayerStickyRight);
  debugMessage("videoPlayerStickyBottom : " + videoPlayerStickyBottom);
  debugMessage("imaSdkUrl : " + imaSdkUrl);
  debugMessage("videoJSCssUrl : " + videoJSCssUrl);
  debugMessage("videoJSJsUrl : " + videoJSJsUrl);
}

function fetchDataJSON(adUrl, jsonPath) {
  this.adUrl = adUrl;

  // Fetch settings for player
  fetch(jsonPath)
    .then(res => res.json())
    .then(data => {
      if (data.debug) debug = data.debug;

      videoPlayerLogo = data.logo;
      videoPlayerLogoOnAd = data.displayLogoOnAd;
      videoPlayerFullscreen = data.displayFullscreen;
      videoPlayerMuted = data.muted;
      videoPlayerSticky = data.playerSticky;

      if (!data.videoSources) {
        console.error('Please check if video sources are specified well');
        return;
      }

      const currentUrl = window.location.href;
      for (let i = 0; i < data.videoSources.length; i++) {
        if (currentUrl.startsWith(data.videoSources[i].domainName)) {
          // In Korea JoongAng Daily, article number should be checked
          const articleNumber = data.videoSources[i].articleNumber;
          if (articleNumber) {
            debugMessage('articleNumber : ' + data.videoSources[i].articleNumber);
            const lastSplitValue = currentUrl.split('/').reverse()[0];
            if (articleNumber !== lastSplitValue) {
              debugMessage(articleNumber + ' does not match with ' + lastSplitValue);
              continue;
            }
          }
          videoSources.push(data.videoSources[i]);
        }
      }

      videoPlayerWrapperId = data.PlayerWrapperId;
      videoSourcesLength = videoSources.length;

      if (!videoSourcesLength) {
        console.error('Please check if video sources are specified well');
        return;
      }

      if (data.playerStickyThreshold) videoPlayerStickyThreshold = data.playerStickyThreshold;
      if (data.playerStickyWidth) videoPlayerStickyWidth = data.playerStickyWidth;
      if (data.playerStickyHeight) videoPlayerStickyHeight = data.playerStickyHeight;
      if (data.playerStickyZIndex) videoPlayerStickyZIndex = data.playerStickyZIndex;
      if (data.playerStickyRight) videoPlayerStickyRight = data.playerStickyRight;
      if (data.playerStickyBottom) videoPlayerStickyBottom = data.playerStickyBottom;

      logoZIndex = data.logo.zIndex ? data.logo.zIndex : logoZIndex;
      imaContainerZIndex = data.imaContainerZIndex ? data.imaContainerZIndex : logoZIndex;

      imaSdkUrl = data.imaSdkUrl;
      videoJSCssUrl = data.videoJSCssUrl;
      videoJSJsUrl = data.videoJSJsUrl;
      if (!imaSdkUrl || !videoJSCssUrl || !videoJSJsUrl) {
        console.error('Please check library urls');
        return;
      }

      if (debug) logFetchedJSONData();

      createVideoPlayerDiv();
    })
    .catch(error => {
      console.error('fetch json error : ' + error);
    });
}

function debugMessage(message) {
  if (debug) console.log(message);
}

function invokeVideoPlayerApp(adUrl, jsonPath) {
  debugMessage('invokeVideoPlayerApp');
  fetchDataJSON(adUrl, jsonPath);
}
