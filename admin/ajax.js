function getXMLHTTPRequest(){
    if (window.XMLHttpRequest){
        return new XMLHttpRequest();
    }
    else{
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
}

function callAjax(url,inner){
    var xmlhttp=getXMLHTTPRequest();
    xmlhttp.open('GET',url,true);
    xmlhttp.onreadystatechange=function(){
        document.getElementById(inner).innerHTML =  '';
        if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)){
            document.getElementById(inner).innerHTML = xmlhttp.responseText;
        }
        return false;
    }
    xmlhttp.send(null);
}

function resetpw(x){
    var id=x;
    var inner="reset";
    var url="reset_password.php?id="+id;
    callAjax(url,inner);
}