# 중앙일보 기사 오프라인 사본

원본: https://www.joongang.co.kr/article/25469354

저장일: 2026-11-02 (한국 시간)

## 열기

이 폴더의 `index.html`을 Chrome 또는 Edge에서 열면 됩니다. 웹 서버나 패키지 설치가 필요하지 않습니다.

다른 위치로 옮길 경우 `news/joongang-25469354` 폴더를 통째로 복사하면 됩니다.

## 저장 내용

- `assets/`: 이미지, CSS, 웹 글꼴, 원본 JavaScript 등 내용이 있는 리소스 333개
- `index.html`: 실행 후 DOM을 기준으로 만든 로컬 HTML
- `offline.js`: 인쇄, 글자 크기, 공유 패널, 맨 위로 이동 등의 로컬 동작
- `original-source.html`, `rendered-original.html`: 원본 응답과 렌더링 후 HTML
- `original-page.mhtml`: Chrome에서 저장한 원본 페이지 스냅샷. Chrome/Edge로 열 수 있습니다.
- `source-css/`: 경로 변경 전 CSS
- `asset-manifest.json`: 원본 URL과 로컬 파일의 대응표 및 저장 여부
- `original-desktop.png`, `offline-desktop.png`, `offline-mobile.png`, `offline-fullpage.png`: 화면 확인 자료
- `verification.json`: 실제 브라우저 검증 결과

본문·사진·글꼴·레이아웃은 오프라인으로 표시됩니다. 원본 사이트의 로그인, 구독, 댓글 전송, 실시간 추천 갱신, 실시간 광고는 서버 연결이 필요하므로 오프라인 사본에서 실행하지 않습니다. 다른 기사와 메뉴의 링크는 원본 사이트로 연결되며 인터넷이 필요합니다. 광고 프레임은 저장 당시 크기를 유지하는 빈 프레임으로 고정했습니다.

일부 광고 입찰·통계 요청, 주석 속 오래된 스크립트, 템플릿 변수 주소는 저장할 수 없거나 표시용 파일이 아닙니다. 실제 HTML과 CSS에서 사용하는 리소스는 모두 로컬 경로로 연결했습니다. 원본 JavaScript는 보관하되 원격 API 호출과 화면 재구성을 막기 위해 실행하지 않습니다.

## 검증

별도 Chrome에서 네트워크를 차단한 뒤 `file:///`로 열어 검증했습니다. 이미지 76개 모두 정상 로드, 외부 HTTP 요청 0건, 웹 글꼴 로드 성공, 1440px 데스크톱과 390px 모바일에서 가로 넘침 없음. 데스크톱 제목 위치, 본문 폭과 전체 문서 높이가 원본과 일치했습니다.
