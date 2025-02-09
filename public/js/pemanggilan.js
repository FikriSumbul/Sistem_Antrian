function panggilPasien(nama, nomorRM) {
    let text = `Pasien dengan nomor rekam medis ${nomorRM}, atas nama ${nama}, harap menuju ruang pemeriksaan.`;

    let utterance = new SpeechSynthesisUtterance(text);
    utterance.lang = 'id-ID'; // Bahasa Indonesia
    utterance.volume = 1; // Volume maksimal
    utterance.rate = 1; // Kecepatan normal
    utterance.pitch = 1; // Pitch normal

    speechSynthesis.speak(utterance);
}
