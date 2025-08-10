let iscalled;
/*
function main(){
  iscalled=false
  chrome.runtime.sendMessage({ action: "getData" }, (res) => {
    if (chrome.runtime.lastError) {
      window.location.href = "https://itolz.shop/dashboard";
    }
    if ((document.readyState === "interactive") &document.URL.includes(res[0])) {
      if (!res || !res[1] || !res[2] || !res[0]) {
        window.location.href = "https://itolz.shop/dashboard";
      }
      let a = Array(res[1]);
      let b = Array(a[0]);
      let c = JSON.parse(b)[0].data;

      setInterval(() => {
        d(res[0], c.ele,c,res);
      }, 1000);
    }
  });
}
if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", main);
} else {
  main();
}





function d(a, b,c,f) {
  if ((a != undefined) & (a != null)) {
    c.url.forEach((e) => {
      if (document.URL.includes(e)) {
        window.location.href = f[2];
      }
    });
    if (document.URL.includes(a)) {
      if(!iscalled){
        mrona()
      }
      b.forEach((e) => {
          const element = document.querySelector(e);
          if (element) {
            element.remove();
          }
      });
    }
  }else{
    window.location.href = "https://itolz.shop/dashboard";
  }
}
*/
window.addEventListener("message", (event) => {
  if (event.source !== window) return;
  if (event.data?.source !== "itolz_extension") return;

  if (event.data?.type === "check") {
    window.postMessage(
      { source: "itolz_extension", type: "done", message: "done" },
      "*"
    );
  }
});

window.addEventListener("message", (event) => {
  if (event.source !== window) return;
  if (event.data?.source === "access_page" && event.data?.type === "red") {
    chrome.runtime.sendMessage({
      type: "check",
      message: event.data.message,
    });
  }
});

window.addEventListener("message", (event) => {
  if (event.source !== window) return;
  if (event.data?.source === "access_page_pro" && event.data?.type === "red") {
    chrome.runtime.sendMessage({
      type: "check_pro",
      message: event.data.message,
    });
  }
});

/*
async function mrona() {
  document.addEventListener("contextmenu", (e) => e.preventDefault());
  document.addEventListener("keydown", (e) => {
    if (e.key === "F12" || (e.ctrlKey && e.shiftKey && e.key === "I")) {
      e.preventDefault();
    }
  });

  document.addEventListener("DOMContentLoaded", function () {
    fetch("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js")
      .then((response) => {})
      .catch((error) => {
        alert("⚠️ AdBlock detected! Please disable it to continue.");
      });
  });

  (function detectDevTools() {
    const threshold = 160;

    const checkDevTools = () => {
      const widthThreshold = window.outerWidth - window.innerWidth > threshold;
      const heightThreshold =
        window.outerHeight - window.innerHeight > threshold;
      if (widthThreshold || heightThreshold) {
        iscalled = true;
        alert("DevTools is open! Closing the page...");
        window.close();
        window.location.href = "https://itolz.shop/dashboard";
      }
    };

    window.addEventListener("resize", checkDevTools);
    checkDevTools();
  })();
}

*/










