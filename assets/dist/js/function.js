function kamera_nyala() {
    if (navigator.mediaDevices) {
    	 initScanner()
    } else {
        alert('Cannot access camera.');
    }
}

