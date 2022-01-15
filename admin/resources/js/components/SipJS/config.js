class Config {

    constructor(){

        let html_audio = "audio_element";
        let html_video = "video_element";
    }

    function getAudioElement(){

        const el = document.getElementById(this.html_audio);

        if(!(el instanceof HTMLAudioElement)){

            throw new Error(`Elemento ${this.html_audio} não encontrado ou não é um elemento de áudio!`)
        }

        this.html_audio = el;
    }
}

export { Config }