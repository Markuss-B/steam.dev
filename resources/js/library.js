window.addEventListener('DOMContentLoaded', (event) => {
    var gameList = document.getElementById("gamelist");


    // Nosaka aktīvo pogu sarakstā
    var btns = gameList.getElementsByTagName("LI")
    for (var i = 0; i < btns.length; i++) {
        // Ja pogai uzspiež tad dod pogau klasi "active" un noņem to pašreiz active pogei, ja tāda ir
        btns[i].addEventListener("click", function() {
            var current = gameList.getElementsByClassName("active");
            var name = this.getElementsByClassName("name")[0].innerHTML;
            if (current.length != 0) {
                current[0].className = current[0].className.replace(" active", "");
            }
            this.className += " active";
        });
    }

    // Nosaka aktīvo bildīti
    // var imgs_c = document.getElementById("images");
    // console.log(imgs_c)
    // var imgs = imgs_c.getElementsByTagName("img");
    // for (var i = 0; i < imgs.length; i++) {
    //     imgs[i].addEventListener("click", function() {
    //         var current = imgs_c.getElementsByClassName("active");
    //         if (current.length != 0) {
    //             current[0].className = current[0].className.replace(" active", "");
    //         }
    //         this.className += " active";
    //         showMedia(this);
    //     });
    // }

    function showMedia(imgs) {
        // Get the media container
        var media = document.getElementById("media-container");
        media.innerHTML = "";
        // Create img element to append src otherwise element dissapears for some reason
        var img = document.createElement("img");
        img.src = imgs.src;
        // Use the same src in container as the image from the grid
        media.append(img);
    }

    // Aizver sidemenu
    function closeBar() {
        $(".sidemenu").addClass("closedside");
        $(".main").addClass("closedside");
        $(".hamburger").addClass("closedside");
    }

    // Atver sidemenu
    function openBar() {
        $(".sidemenu").removeClass("closedside");
        $(".main").removeClass("closedside");
        $(".hamburger").removeClass("closedside");
    }

    var btn_s = document.getElementById("closeBtn");
    btn_s.addEventListener("click", closeBar);
    var hamburger_s = document.getElementById("hamBtn");
    hamburger_s.addEventListener("click", openBar);

    var homeBtn_s = document.getElementById("homeBtn");
    homeBtn_s.addEventListener("click", function() {showThis('home');});

    /*// sameklē spēli sarakstā
    function searchGame() {
        var input, filter, table, li, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        console.log(filter);
        table = document.getElementById("gamelist");
        li = table.getElementsByTagName("li");
        for (var i = 0; i < li.length; i++) {
            var game = li[i].getElementsByClassName("name")[0];
            if (game) {
                txtValue = game.textContent || game.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }
    }*/

    function filterByName(list) {
        var input, filter;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();

        if (input.length == 0) return list;
        let newlist = [];
        for (var i = 0; i < list.length; i++) {
            if (list[i].toUpperCase().indexOf(filter) > -1) {
                newlist.push(list[i]);
            }
        }
        return newlist
    }

    function filterByHours(list) {
        let minhours_s = document.getElementById("minhours").value;
        let minhours = Number(minhours_s);
        let maxhours_s = document.getElementById("maxhours").value;
        let maxhours = Number(maxhours_s);

        if (minhours_s.length == 0 && maxhours_s.length == 0) return list;

        let newlist = [];
        for (var i = 0; i < list.length; i++) {
            var name = list[i];
            var hours = gamehours[gamedata[name]];
            if (hours) {
                if ((hours >= minhours || minhours_s.length == 0) && (hours <= maxhours || maxhours_s.length == 0)) {
                    newlist.push(list[i]);
                }
            }
        }
        return newlist;
    }

    function filterGames() {
        var table, li, txtValue;
        table = document.getElementById("gamelist");
        li = table.getElementsByTagName("li");
        let nameList = [];
        for (var i = 0; i < li.length; i++) {
            var game = li[i].getElementsByClassName("name")[0].textContent;
            nameList.push(game);
        }
        //console.log(nameList);
        nameList = filterByName(nameList);
        //console.log(nameList);
        nameList = filterByHours(nameList);
        //console.log(nameList);

        for (var i = 0; i < li.length; i++) {
            var game = li[i].getElementsByClassName("name")[0];
            if (game) {
                txtValue = game.textContent || game.innerText;
                if (nameList.indexOf(txtValue) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }
    }

    var search_s = document.getElementById("searchInput");
    search_s.addEventListener("keyup", filterGames);

    // Error validators stundu ievadei
    function searchHours() {
        let minhours_s = document.getElementById("minhours").value;
        let minhours = Number(minhours_s);
        let maxhours_s = document.getElementById("maxhours").value;
        let maxhours = Number(maxhours_s);
        let errorOutput = document.getElementById("hours_warning");

        let errors = [];

        if (isNaN(minhours) || isNaN(maxhours)) {
            errors.push("Not a number");
        }

        if (minhours < 0 || maxhours < 0) {
            errors.push("Negative hours");
        }

        if (maxhours < minhours && !(maxhours_s.length == 0 || minhours_s.length == 0)) {
            errors.push("max > min")
        }

        errorOutput.innerHTML = '';

        if (errors.length > 0) {
            errorOutput.innerHTML = errors.join(" ");
            return false;
        }

        if (minhours_s.length == 0) {
            minhours = 0;
        }
        if (maxhours_s.length == 0) {
            maxhours = 999999;
        }
        console.log(minhours);
        console.log(maxhours);

        filterGames();
        /*// Paslēpj spēles kuras neieilpst stundās
        let list = document.getElementById("gamelist");
        let lis = list.getElementsByTagName("li");
        for (var i = 0; i < lis.length; i++) {
            var name = lis[i].getElementsByClassName("name")[0].innerHTML;
            var hours = gamehours[gamedata[name]];
            if (hours) {
                if (hours >= minhours && hours <= maxhours) {
                    lis[i].style.display = "";
                } else {
                    lis[i].style.display = "none";
                }
            }
        }*/
    }

    document.getElementById("minhours").addEventListener("keyup", searchHours);
    document.getElementById("maxhours").addEventListener("keyup", searchHours);
})


// Sakārto sidemenu alfabētiskā secībā
function sortGameList(list) {
    var i, switching, b, shouldSwitch;
    switching = true;
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
      // start by saying: no switching is done:
      switching = false;
      b = list.getElementsByTagName("LI");
      // Loop through all list-items:
      for (i = 0; i < (b.length - 1); i++) {
        // start by saying there should be no switching:
        shouldSwitch = false;
        /* check if the next item should
        switch place with the current item: */
        if (b[i].innerText.toLowerCase() > b[i + 1].innerText.toLowerCase()) {
          /* if next item is alphabetically
          lower than current item, mark as a switch
          and break the loop: */
          shouldSwitch = true;
          break;
        }
      }
      if (shouldSwitch) {
        /* If a switch has been marked, make the switch
        and mark the switch as done: */
        b[i].parentNode.insertBefore(b[i + 1], b[i]);
        switching = true;
      }
    }
}