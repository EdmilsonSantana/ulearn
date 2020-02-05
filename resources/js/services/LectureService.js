export default class LectureService {

    constructor(site_url) {
        this.site_url = site_url;
    }

    updateLectureStatus(lecture, is_completed) {
        
        console.log(lecture);
        console.log("Atualizando status da Atividade...");

        let url = `${this.site_url}/update-lecture-status/${lecture.course_id}/${lecture.lecture_quiz_id}/${is_completed}`;
        
        console.log("URL: ", url);

        return axios.get(url).catch((error) =>  {
            console.log(error);
        });
    }
}