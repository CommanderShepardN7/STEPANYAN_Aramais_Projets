package com.example.smarttrucker.OtherClasses;

public class Question {

    private String questionText, urlVideo, reponse1, reponse2, reponse3, reponse4;

    public Question(String questionText,String reponse1,String reponse2,String reponse3,String reponse4) {
        this.questionText = questionText;
        this.reponse1 = reponse1;
        this.reponse2 = reponse2;
        this.reponse3 = reponse3;
        this.reponse4 = reponse4;
    }

    public Question(String questionText, String urlVideo, String reponse1,String reponse2,String reponse3,String reponse4) {
        this.questionText = questionText;
        this.urlVideo = urlVideo;
        this.reponse1 = reponse1;
        this.reponse2 = reponse2;
        this.reponse3 = reponse3;
        this.reponse4 = reponse4;
    }



    public String getQuestionText() {
        return questionText;
    }

    public String getUrlVideo() {
        return urlVideo;
    }

    public String getReponse1() {
        return reponse1;
    }

    public String getReponse2() {
        return reponse2;
    }

    public String getReponse3() {
        return reponse3;
    }

    public String getReponse4() {
        return reponse4;
    }



}

