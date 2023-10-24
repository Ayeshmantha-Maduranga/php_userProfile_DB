// <---- var
var qrSrc = '';
var Primarykey = '';

// <----------------------- UI FUNCTIONS ---------------------------
function showTab(tabName) {
    const tabs = document.querySelectorAll('.tab-content');
    tabs.forEach(tab => tab.classList.remove('active'));

    const tab = document.getElementById(tabName);
    tab.classList.add('active');

    // Hide the success message when switching tabs
    const successMessage = document.querySelector('.success-message');
    successMessage.style.display = 'none';
}

function clearRegForm() {
    const form = document.querySelector('.regFrom');
    form.reset();
}
// ------------------------- SEARCH DATA -------------------------------
function getPrimaryKey(qrCode) {
    if (qrCode) {
        $.ajax({
            url: "search.php",
            type: "POST",
            data: {
                input: qrCode
            },
            cache: false,
            success: function (dataResult) {
                var dataResult = JSON.parse(dataResult);
                if (dataResult.statusCode == 200) {
                    // alert(dataResult.id);
                    Primarykey = dataResult.id;
                }
                else if (dataResult.statusCode == 201) {
                    alert("Error occured !");
                }
            }
        });

    } else {
        alert("QR passcode Gen field !");
    }
}


// --------------------------- CODE GEN ------------------------------------
function generatePassword(length) {
    const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+[]{}|;:,.<>?";
    let password = "";

    for (let i = 0; i < length; i++) {
        const randomIndex = Math.floor(Math.random() * charset.length);
        password += charset[randomIndex];
    }

    return password;
}
// ----------------------- DOWNLOAD QR -----------------------------------
function downloadURI(uri, name) {
    var link = document.createElement("a");
    link.download = name;
    link.href = uri;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    delete link;
};

// ----------------------- QRCODE GEN -------------------------------------
function generateQRCode(qrPassCode) {
    if (qrPassCode) {
        let qrcodeContainer = document.getElementById("qrcode");
        qrcodeContainer.innerHTML = "";
        new QRCode(qrcodeContainer, qrPassCode);
        document.getElementById("regFrom").style.display = "None";
        document.getElementById("qrcode-container").style.display = "block";
        //gen dwonload path
        setTimeout(function () {
            qrSrc = qrcodeContainer.querySelector('img').src;
            // alert(dataUrl);
        }, 500);
    } else {
        alert("QR passcode Gen field !");
    }
}
// ---------------------------- SETUP WHEN STARTUP -------------------------------------
$(document).ready(function () {
    // <-------------- DB INSERT VAL --------------------
    $('#BtnReg').on('click', function () {
        $("#BtnReg").attr("disabled", "disabled");

        //<------- get from values 
        var name = $('#regName').val();
        var email = $('#regEmail').val();
        var telNumber = $('#regTelNumber').val();
        var address = $('#regAddress').val();
        var gender = $('input[name="gender"]:checked').val();
        var qrCode = generatePassword(12);

        // <----- query call 
        if (name != "" && email != "" && telNumber != "" && gender != '') {
            $.ajax({
                url: "insert.php",
                type: "POST",
                data: {
                    name: name,
                    gender: gender,
                    email: email,
                    telNumber: telNumber,
                    address: address,
                    qrCode: qrCode
                },
                cache: false,
                success: function (dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 200) {
                        // alert("succcses !");
                       
                         generateQRCode(qrCode);
                         getPrimaryKey(qrCode);

                        // downloadURI(qrSrc, Primarykey + '.png');
                        // clearRegForm();
                    }
                    else if (dataResult.statusCode == 201) {
                        alert("Error occured !");
                    }
                }
            });
        }
        else {
            alert('Please fill all required the field !');
        }
    });

    // ----------------------------------------------------------
    $('#BtnQRDownLoad').on('click', function () {
        downloadURI(qrSrc, Primarykey + '.png');
        clearRegForm();
        document.getElementById("regFrom").style.display = "block";
        document.getElementById("qrcode-container").style.display = "None";
    });
});
