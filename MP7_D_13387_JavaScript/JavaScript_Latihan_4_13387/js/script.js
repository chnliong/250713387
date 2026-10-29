function fn_ValForm(){
    var sMsg = "";
    var nama = document.getElementById("nama").value;
    var kategori = document.getElementById("kategori").value;
    var umur = document.getElementById("umur").value;
    var email= document.getElementById("email").value;
    var compareEmail = /^[a-z0-9][a-z0-9_\.-]{0,}[a-z0-9]@[a-z0-9][a-z0-9_\.-]{0,}[a-z0-9][\.][a-z0-9]{2,4}$/;

    if(document.getElementById("nama").value == ""){
        sMsg += "\n* Anda belum mengisikan nama";
    }

    if(document.getElementById("email").value == ""){
        sMsg += "\n* Anda belum mengisikan email";
    } else if(!compareEmail.test(email)) {
        alert("Email tidak valid!");
    }

    if(document.getElementById("umur").value == ""){
        sMsg += "\n* Anda belum mengisikan umur";
    } else {
        var informasi = "";
       var iumur = parseInt(umur);
        if(iumur >= 15 && umur <= 60){
            if(umur <= 25) {
                informasi += "\n*Peserta Mahasiswa";
            } else {
                informasi += "\n*Peserta Umum";
            }
        } else {
            alert("Umur harus berada diantara 15 sampai 60 tahun");
        }
    }

    
    if(document.getElementById("kategori").value == ""){
        sMsg += "\n* Anda belum mengisikan jenis acara";
    } else {
        var info = "";
        switch(kategori) {
            case "W":
                info = "\n*Acara yang dipilih adalah Workshop";
                break;
            case "S":
                info = "\n*Acara yang dipilih adalah Seminar";
                break;
            case "L":
                info = "\n*Acara yang dipilih adalah Lomba Coding";
                break;
        }
    }

    if(sMsg != ""){
        alert("Peringatan:\n" + sMsg);
        return false;
    } 
        alert("Terima kasih " + nama + "! Anda terdaftar di acara" + info+ "("+informasi+")");
       // alert("Terima kasih " + nama + "! Anda terdaftar di acara" + kategori+ "("+info+")");
        return true; 
}