var Timings=window.performance||window.mozPerformance||window.webkitPerformance||window.msPerformance;beacon=function(e){e=e||{};e.url=e.url||null;e.vars=e.vars||{};e.error=e.error||function(){};e.success=e.success||function(){};var t=[];for(var n in e.vars){t.push(n+"="+e.vars[n])}var r=t.join("&");if(e.url){var i=new Image;if(i.onerror){i.onerror=e.error}if(i.onload){i.onload=e.success}i.src=e.url+"?"+r}};window.onload=function(){setTimeout(function(){var e=Timings.timing.loadEventEnd-Timings.timing.domLoading;var t=Timings.timing.responseEnd-Timings.timing.requestStart;if(t<0){t=0}var n=Timings.timing.responseEnd-Timings.timing.fetchStart;var r=e+t+n;var i=window.location.href;var s=document.referrer;beacon({url:"https://www.statuscake.com/App/Workfloor/RUM/Save.php",vars:{DOMLoad:e,RUMID:RumID,Connection:t,Network:n,TotalTime:r,Location:encodeURIComponent(i),Referer:encodeURIComponent(s)},error:function(){}})},0)}