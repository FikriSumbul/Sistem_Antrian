function panggilPasien(nama, nomor_rm) {
    let text = `Pasien dengan nomor rekam medis ${nomor_rm}, atas nama ${nama}, silahkan menuju ke loket.`;

    let utterance = new SpeechSynthesisUtterance(text);
    utterance.lang = 'id-ID'; // Bahasa Indonesia
    utterance.volume = 1; // Volume maksimal
    utterance.rate = 1; // Kecepatan normal
    utterance.pitch = 1; // Pitch normal

    speechSynthesis.speak(utterance);
}
