
// url Async requesting function
function httpGetAsync(theUrl,callback)
{
    // create the request object
    var xmlHttp = new XMLHttpRequest();

    // set the state change callback to capture when the response comes in
    xmlHttp.onreadystatechange = function()
    {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
        {
            callback(xmlHttp.responseText);
        }
    }

    // open as a GET call, pass in the url and set async = True
    xmlHttp.open("GET", theUrl, true);

    // call send with no params as they were passed in on the url string
    xmlHttp.send(null);

    return;
}

// callback for trending top 10 GIFs
function tenorCallback_trending(responsetext)
{
    // parse the json response
    var response_objects = JSON.parse(responsetext);

    top_10_gifs = response_objects["results"];

    // load the GIFs -- for our example we will load the first GIFs preview size (nanogif) and share size (tinygif)
    let h='';
    $.each(top_10_gifs,function(key,index){
        //console.log(index);
        //console.log(index.media[0].tinygif.url);
        //console.log(index.id);
        //h+='<img src="'+index.media[0].tinygif.url+'" style="width:100%;height:20vh;object-fit:cover;" />'
        //h+='<img id="share_gif" src="'+index.media[0].tinygif.url+'" alt=""  style="width:100%;height:20vh;object-fit:cover;" >';
        h+='<div class="col-xs-4" style="padding:4px;" onclick="pick('+index.id+')"><img src="'+index.media[0].tinygif.url+'"  style="width:100%;height:20vh;object-fit:cover;" /></div>';
    });
    $('#loaded').html(h);
    //document.getElementById("preview_gif").src = top_10_gifs[0]["media"][0]["nanogif"]["url"];

    //document.getElementById("share_gif").src = top_10_gifs[0]["media"][0]["tinygif"]["url"];
    
    return;

}

function tenorCallback_search(responsetext)
{
    // parse the json response
    var response_objects = JSON.parse(responsetext);

    top_10_gifs = response_objects["results"];

    let h='';
    $.each(top_10_gifs,function(key,index){
        //console.log(index);
        //console.log(index.media[0].tinygif.url);
        //h+='<img id="share_gif" src="'+index.media[0].tinygif.url+'" alt="" style="">';
        h+='<div class="col-xs-4" style="padding:4px;" onclick="pick('+index.id+')"><img src="'+index.media[0].tinygif.url+'" class="bg-input" style="width:100%;height:20vh;object-fit:cover;" /></div>';
    });
    $('#loaded').html(h);

    // load the GIFs -- for our example we will load the first GIFs preview size (nanogif) and share size (tinygif)

    //document.getElementById("preview_gif").src = top_10_gifs[0]["media"][0]["nanogif"]["url"];

    //document.getElementById("share_gif").src = top_10_gifs[0]["media"][0]["tinygif"]["url"];

    return;

}

// function to call the trending and category endpoints
function grab_gif_data(type,id)
{
    // set the apikey and limit
    //console.log(type);
    var apikey = "YEV668HDEUQE";

    // GIF id
    var gif_id = id;

    // using default locale of en_US
    var search_url = "https://api.tenor.com/v1/gifs?ids=" + gif_id + "&key=" +
            apikey;
    if(type=='search'){
        httpGetAsync(search_url,tenorCallback_gifs);
    }else{
        httpGetAsync(search_url,tenorCallback_gifsPosts);
    }
    // data will be loaded by each call's callback
    return;
}

// callback for the requested gifPosts
function tenorCallback_gifsPosts(responsetext)
{
    // parse the json response
    var response_objects = JSON.parse(responsetext);

    var gif = response_objects["results"];

    // load the GIFs -- for our example we will load the first GIFs preview size (nanogif) and share size (tinygif)
    //console.log('a',gif[0]["id"]);
    //document.getElementById("gif_preview").classList.remove('hide');
    //document.getElementById("gif_preview").src = gif[0]["media"][0]["tinygif"]["url"];

    document.getElementById(gif[0]["id"]).src = gif[0]["media"][0]["tinygif"]["url"];

    return;

}

// callback for the requested gif
function tenorCallback_gifs(responsetext)
{
    // parse the json response
    var response_objects = JSON.parse(responsetext);

    var gif = response_objects["results"];

    // load the GIFs -- for our example we will load the first GIFs preview size (nanogif) and share size (tinygif)
    //console.log(gif);
    document.getElementById("gif_preview").classList.remove('hide');
    document.getElementById("gif_preview").src = gif[0]["media"][0]["tinygif"]["url"];
    document.getElementById("gifer").value =gif[0]["id"];

    //document.getElementById("share_gif").src = gif[0]["media"][0]["tinygif"]["url"];

    return;

}


// function to call the trending and category endpoints
function grab_data()
{
    // set the apikey and limit
    var apikey = "YEV668HDEUQE";
    var lmt = 10;

    // get the top 10 trending GIFs (updated through out the day) - using the default locale of en_US
    var trending_url = "https://api.tenor.com/v1/trending?key=" + apikey + "&limit=" + lmt;
    httpGetAsync(trending_url,tenorCallback_trending);
    

    // data will be loaded by each call's callback
    return;
}

function grab_search_data(dat)
{
    // set the apikey and limit
    var apikey = "LIVDSRZULELA";
    var lmt = 18;

    // test search term
    var search_term = dat;

    // using default locale of en_US
    var search_url = "https://api.tenor.com/v1/search?q=" + search_term + "&key=" +
            apikey + "&limit=" + lmt;

    httpGetAsync(search_url,tenorCallback_search);

    // data will be loaded by each call's callback
    return;
}

// SUPPORT FUNCTIONS ABOVE
// MAIN BELOW

function pick(id){
    window.history.back();
    grab_gif_data('search',id)
}
