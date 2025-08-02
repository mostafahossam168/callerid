// Click tog-show
if (document.querySelector(".tog-show")) {
    let togglesShow = document.querySelectorAll(".tog-show");
    togglesShow.forEach((e) => {
        let togg = true;
        e.addEventListener("click", (evt) => {
            let listItem = document.querySelector(e.getAttribute("data-show"));
            if (togg == true) {
                listItem.style.display = "flex";
                togg = false;
            } else {
                listItem.style.display = "none";
                togg = true;
            }
        });
    });
}
// csv file
if (document.getElementById("export-btn")) {

    function downloadCSVFile(csv, filename) {
        var csv_file, download_link;
        csv_file = new Blob(["\uFEFF" + csv], {
            type: "text/csv"
        });
        download_link = document.createElement("a");
        download_link.download = filename;
        download_link.href = window.URL.createObjectURL(csv_file);
        download_link.style.display = "none";
        document.body.appendChild(download_link);
        download_link.click();
    }

    function htmlToCSV(html, filename) {
        var data = [];
        var rows = document.querySelectorAll("table tr");
        for (var i = 0; i < rows.length; i++) {
            var row = [],
                cols = rows[i].querySelectorAll("td, th");
            for (var j = 0; j < cols.length; j++) {
                row.push(cols[j].innerText);
            }
            data.push(row.join(","));
        }
        downloadCSVFile(data.join("\n"), filename);
    }

    document.getElementById("export-btn").addEventListener("click", function () {
        var html = document.getElementById("data-table").outerHTML;
        htmlToCSV(html, "report.csv");
    });
}

// scroll top effect
const upBtn = document.querySelector(".up-btn");

if(upBtn) {
    window.addEventListener("scroll", () =>
        this.scrollY >= 160
            ? upBtn.classList.add("show")
            : upBtn.classList.remove("show")
    );
    upBtn.addEventListener("click", () =>
        this.scrollTo({
            top: 0,
            behavior: "smooth",
        })
    );
}

if(document.querySelector('.myButton')) {

    // print
    $('.myButton').on('click',function(){
        console.log($(this).data('id'))
        var  myId = $(this).data('id')
    })
    $('.print-btn').on('click',function(){
        var id = $(this).data('id');
        console.log(id);
        if (document.getElementById("prt-content")) {
        var btnPrtContent = document.querySelector("#btn-prt-content");
        var btnPrtContent = document.querySelector(`#btn-prt-content1${id}`);
        printDiv();
        function printDiv() {
            var prtContent = document.querySelector("#prt-content");
            var prtContent = document.querySelector(`#prt-content1${id}`);
            newWin = window.open("");
            newWin.document.head.replaceWith(document.head.cloneNode(true));
            newWin.document.body.appendChild(prtContent.cloneNode(true));
            setTimeout(() => {
                newWin.print();
                newWin.close();
            }, 600);
        }
        }
    });
}

// loader window
if (document.querySelector(".loader-container")) {
    document.body.classList.add("overflow-hidden");
    const loaderContainer = document.querySelector(".loader-container");
    window.addEventListener("load", () => {
        setTimeout(() => {
            loaderContainer.classList.add("hidden-loader");
            document.body.classList.remove("overflow-hidden");
        }, 200);
    });
}

// print
if (document.getElementById("prt-content")) {
    var btnPrtContent = document.getElementById("btn-prt-content");
    btnPrtContent.addEventListener("click", printDiv);
    function printDiv() {
        var prtContent = document.getElementById("prt-content");
        newWin = window.open("");
        newWin.document.head.replaceWith(document.head.cloneNode(true));
        newWin.document.body.appendChild(prtContent.cloneNode(true));
        setTimeout(() => {
            newWin.print();
            newWin.close();
        }, 600);
    }
}

function printById(id) {
    var prtContent = document.getElementById(id);
    newWin = window.open("");
    newWin.document.head.replaceWith(document.head.cloneNode(true));
    newWin.document.body.appendChild(prtContent.cloneNode(true));
    setTimeout(() => {
        newWin.print();
        newWin.close();
    }, 600);
}

function checkInputNumber(input) {
    const lastInput = input.value.slice(-1);

    if (!/^\d$/.test(lastInput)) { 
        input.value = input.value.slice(0, -1);
    }
}
