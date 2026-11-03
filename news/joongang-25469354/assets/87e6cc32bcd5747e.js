'use strict';

let recreateTokenCnt = 1;
const PushPath = {
    log: utils.config.apiPath + 'pwa.log',
    subscribe: utils.config.apiPath + 'pwa.insert',
    update: utils.config.apiPath + 'pwa.update'
};
const SERVICE_WORKER = 'https://www.joongang.co.kr/pwa/sw.js?v=202611021332';

const vapidKey = 'BLOifezezA4UWcu0uKPFQwXoYw0gHQb-NEfduSMVFMGqbVhhhT_Q8yVQ3A9jNJRDU1KJlgmIDyvj3zjCJ7KPIJ0';
const firebaseConfig = {
    apiKey: "AIzaSyDSj_MtFSY9RGiKZ4M1ny-kAjQ5oB371x8",
    authDomain: "joongangilbomobileapp.firebaseapp.com",
    projectId: "joongangilbomobileapp",
    messagingSenderId: "1078834563251",
    appId: "1:1078834563251:web:ddc70fcae9b87aff0408c6"
};

const pcid = utils.pcid.get();
firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging.isSupported() ? firebase.messaging() : null;
messaging && messaging.usePublicVapidKey(vapidKey);
if (!utils.device.joongangApp && 'serviceWorker' in navigator) {
    navigator.serviceWorker.register(SERVICE_WORKER)
    .then(function(registration) {
        messaging.useServiceWorker(registration);

        messaging.onTokenRefresh(function() {
            console.log('토큰 재발급');
            getToken();
        });

        messaging.onMessage(function(payload) {
            console.log('메시지', payload);
        });

        requestPermission();
    });
}

const requestPermission = function() {
    const currentToken = getLocalStorageItem('token');
    const tokenFlag = getLocalStorageItem('tokenFlag');

    Notification.requestPermission()
    .then(function(permission) {
        if (permission === 'granted') {
            console.log('푸시 허용');

            // 모바일 토큰
            if (utils.device.mobile && tokenFlag === null && currentToken !== null && currentToken !== 'D') {
                send('subscribe', {dev: device(), os: os(), newToken: currentToken, oldToken: null, pcid: pcid})
                .then(function() {
                    setLocalStorageItem('tokenFlag', 'done');
                });
            }

            // 토큰 발급
            getToken();
        } else if (permission === 'denied') {
            console.log('푸시 차단');
            if (currentToken !== 'D') {
                send('log', {allow: 'N', referrer: getReferrerDomain() || '', dev: device(), browser: browser(), pcid: pcid})
                .then(function() {
                    setLocalStorageItem('token', 'D');
                    localStorage.removeItem('tokenFlag');
                });
            }
        } else {
            console.log('푸시 기본값');
        }
    });
};

const getToken = function() {
    if (recreateTokenCnt >= 0) {
        messaging.getToken()
        .then(function(currentToken) {
            let token = getLocalStorageItem('token');
            if (currentToken && token !== currentToken) {
                send('subscribe', {dev: device(), os: os(), newToken: currentToken, oldToken: token, pcid: pcid})
                .then(function() {
                    setLocalStorageItem('token', currentToken);
                })
                .then(function() {
                    send('log', {allow: 'Y', referrer: getReferrerDomain() || '', dev: device(), browser: browser(), pcid: pcid});
                });
            } else {
                const utm = utils.queryStringToObject(window.location.href).utm_source;
                if ((utm && utm === 'pwa') && utils.member.isMem()) {//PWA 클릭이고, 로그인 상태이면 회원 정보 업데이트
                    send('update', {dev: device(), os: os(), token: currentToken, pcid: pcid})
                    .then(function() {
                        console.log("푸시 토큰 사용자 정보 update");
                    })
                }
            }
        })
        .catch(function(err) {
            recreateTokenCnt--;
            console.log('토큰 가져오기 실패', err);
            getToken();
        });
    }
};

const send = function(service, payload) {
    return fetch(PushPath[service], {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
        credentials: "include",
        mode: 'no-cors',
        body: makeParams(payload)
    })
    .then(function(response) {
        console.log(response);
    })
    .catch(function(err) {
        console.log(err);
    });
};

const makeParams = function(info) {
    var returnValue = "";

    Object.keys(info).forEach(function (key) {
        returnValue += returnValue.length > 0 ? "&" : "";
        returnValue += key + '=' + info[key];
    });

    return returnValue;
}

const getReferrerDomain = function() {
    let referrer = document.referrer;
    return referrer;
};

const device = function() {
    
    return utils.device.pc ? 'P' : 'M';
}

const os = function() {
    return 'WIN';
}

const browser = function() {
    var ua = navigator.userAgent.toLowerCase();
    var bc = 8;

    if (ua.indexOf('firefox') > -1) {
        bc = 2;
    } else if (ua.indexOf('opr') > -1) {
        bc = 3;
    } else if (ua.indexOf('edg') > -1) {
        bc = 4;
    } else if (ua.indexOf('whale') > -1) {
        bc = 5;
    } else if (ua.indexOf('samsungbrowser') > -1) {
        bc = 6;
    } else if (ua.indexOf('ucbrowser') > -1) {
        bc = 6;
    } else if (ua.indexOf('chrome') > -1) {
        bc = 1;
    } else {
        bc = 8;
    }
    return bc;
}

const getLocalStorageItem = function (k) {
    return localStorage.getItem(k);
}
const setLocalStorageItem = function (k, v) {
    localStorage.setItem(k, v);
}
const checkLocalStorageItem = function (k, v) {
    return localStorage.getItem(k) === v;
}
