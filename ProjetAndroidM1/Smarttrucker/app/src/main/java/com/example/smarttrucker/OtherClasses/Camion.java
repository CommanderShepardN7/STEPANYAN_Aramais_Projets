package com.example.smarttrucker.OtherClasses;

import android.os.Parcel;
import android.os.Parcelable;

public class Camion implements Parcelable {
    private String nom;
    private int carburantActuelLitre;
    private int reservoirMaxLitre;
    private int etat;


    public Camion(String nom, int reservoirMaxLitre) {
        this.nom = nom;
        this.reservoirMaxLitre = reservoirMaxLitre;
        this.carburantActuelLitre = reservoirMaxLitre;
        this.etat = 100;
    }

    public Camion(String nom, int reservoirMaxLitre, int carburantActuelLitre, int etat) {
        this.nom = nom;
        this.reservoirMaxLitre = reservoirMaxLitre;
        this.carburantActuelLitre = carburantActuelLitre;
        this.etat = etat;
    }


    public int getCarburantActuelLitre() {
        return carburantActuelLitre;
    }

    public void setCarburantActuelLitre(int carburantActuelLitre) {
        this.carburantActuelLitre = carburantActuelLitre;
    }

    public int getEtat() {
        return etat;
    }

    public void setEtat(int etat) {
        this.etat = etat;
    }

    public String getNom() {
        return nom;
    }

    public int getReservoirMaxLitre() {
        return reservoirMaxLitre;
    }

    @Override
    public String toString() {
        return "Camion{" +
                "nom='" + nom + '\'' +
                ", carburantActuelLitre=" + carburantActuelLitre +
                ", reservoirMaxLitre=" + reservoirMaxLitre +
                ", etat=" + etat +
                '}';
    }

    protected Camion(Parcel in) {
        nom = in.readString();
        carburantActuelLitre = in.readInt();
        reservoirMaxLitre = in.readInt();
        etat = in.readInt();
    }

    public static final Creator<Camion> CREATOR = new Creator<Camion>() {
        @Override
        public Camion createFromParcel(Parcel in) {
            return new Camion(in);
        }

        @Override
        public Camion[] newArray(int size) {
            return new Camion[size];
        }
    };

    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel dest, int flags) {
        dest.writeString(nom);
        dest.writeInt(carburantActuelLitre);
        dest.writeInt(reservoirMaxLitre);
        dest.writeInt(etat);
    }
}
