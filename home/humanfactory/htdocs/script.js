// JavaScript Document	
<!--
browser = navigator.appName;
version = parseInt(navigator.appVersion);
    if ((browser == "Netscape" && version >= 3) || 
        (browser == "Microsoft Internet Explorer" && version >= 4)) dynamic = "YES"; 
    else dynamic = "NO";
    
    if (dynamic== "YES") {
nv1b = new Image();          // 
nv1b.src = "/images/homplay_off.gif";
nv2b = new Image();          // 
nv2b.src = "/images/homteach_off.gif";
nv3b = new Image();          // 
nv3b.src = "/images/homcareers_off.gif";
nv4b = new Image();          // 
nv4b.src = "/images/homabout_off.gif";	
nv5b = new Image();          // 
nv5b.src = "/images/homtarget_off.gif";	
nv6b = new Image();          // 
nv6b.src = "/images/tophome_off.gif";
nv7b = new Image();          // 
nv7b.src = "/images/topplay_off.gif";
nv8b = new Image();          // 
nv8b.src = "/images/topteach_off.gif";
nv9b = new Image();          // 
nv9b.src = "/images/topcareers_off.gif";
nv10b = new Image();          // 
nv10b.src = "/images/topabout_off.gif";
nv11b = new Image();          // 
nv11b.src = "/images/back_top_off.gif";
nv12b = new Image();          // 
nv12b.src = "/images/back_top_off.gif";
nv13b = new Image();          // 
nv13b.src = "/images/back_top_off.gif";

nv1a = new Image();          // 
nv1a.src = "/images/homplay_on.gif";
nv2a = new Image();          // 
nv2a.src = "/images/homteach_on.gif";
nv3a = new Image();          // 
nv3a.src = "/images/homcareers_on.gif";
nv4a = new Image();          // 
nv4a.src = "/images/homabout_on.gif";
nv5a = new Image();          // 
nv5a.src = "/images/homtarget_on.gif";
nv6a = new Image();          // 
nv6a.src = "/images/tophome_on.gif";
nv7a = new Image();          // 
nv7a.src = "/images/topplay_on.gif";
nv8a = new Image();          // 
nv8a.src = "/images/topteach_on.gif";
nv9a = new Image();          // 
nv9a.src = "/images/topcareers_on.gif";
nv10a = new Image();          // 
nv10a.src = "/images/topabout_on.gif";
nv11a = new Image();          // 
nv11a.src = "/images/back_top_on.gif";
nv12a = new Image();          // 
nv12a.src = "/images/back_top_on.gif";
nv13a = new Image();          // 
nv13a.src = "/images/back_top_on.gif";
     }


function imgInact(imgName) {
    if (dynamic== "YES") {
    document[imgName].src = eval(imgName + "b.src");
    }
}

function imgAct(imgName) {
    if (dynamic== "YES") {
    document[imgName].src = eval(imgName + "a.src");
    }
}
function goOn(src){

}
function goOff(src){

}

// -->

<!--
if ((navigator.appName == "Microsoft Internet Explorer") && (parseInt(navigator.appVersion) < 4 )) {
   document.write("<LINK REL=stylesheet HREF=\"/win.css\" TYPE=\"text/css\">"); }
else if ((navigator.appVersion.indexOf("Mac") != -1)) {
   document.write("<LINK REL=stylesheet HREF=\"/mac.css\" TYPE=\"text/css\">"); }
else {
   document.write("<LINK REL=stylesheet HREF=\"/win.css\" TYPE=\"text/css\">"); }
// -->
