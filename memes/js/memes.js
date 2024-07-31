$(()=>{
    fetch('https://www.reddit.com/api/v1/access_token', {
        method: "POST",
        body: new URLSearchParams({
            "grant_type": "client_credentials",
        }),
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
            "Authorization": "Basic " + btoa("IK4RFUF0iLw5GZKveewn0Q:Sqr8x_ggQA59d0qafTYLWTY2R5I8vQ"),
            //"User-Agent": "memes crawler by u/ecstatichades17"
        },
        
    }).then(async (rs)=>{
        if (rs.ok){
            return rs.json();
        }
        else {
            alert("Couldn't Authenticate with Reddit: "+rs.status);
        }
    }).then(async (token_data)=>{
        var token = token_data["access_token"];
        return fetch("https://oauth.reddit.com/r/memes/hot?"+ new URLSearchParams({
            "raw_json": 1,
            "limit": 50,
            "after": "t3_1e2rfwg"
        }),
        {
            method: "GET",
            headers: {
                "Authorization": "bearer "+token,
                "User-Agent": "memes crawler by u/ecstatichades17"
            }
        });
    }).then((rs)=>{
        if (rs.ok){
            return rs.json();
        }
        else {
            alert("Couldn't fetch posts: "+rs.status);
        }
    }).then((posts)=>{
        var alt = false;
        var bg_right = $(".bg.right");
        var bg_left = $(".bg.left");
        var bg_center = $(".bg.center");
        var bg_mobile = $(".bg.mobile");
        var sw = ()=>{
            if (alt === false){
                alt = true;
                return bg_left;
            }
            else if (alt === true){
                alt = null;
                return bg_center;
            }
            else {
                alt = false;
                return bg_right;
            }
        };
        sources = new Array();
        posts["data"]["children"].forEach(element => {
            sw() // Alternate between left, center, and right
            .add(bg_mobile) // Add the center to the current selection
            .append("\
            <div class=\"bg meme\"> \
            <img src=\"" + element["data"]["url"] +"\" class=\"bg\">\
            </"+"div>"); //append the actual image
            sources.push("https://www.reddit.com"+element["data"]["permalink"]);
        });
        bg_right.add([bg_left, bg_center, bg_mobile]).toggleClass("animate");
        sessionStorage.setItem("sources", sources);
        
    });
})
