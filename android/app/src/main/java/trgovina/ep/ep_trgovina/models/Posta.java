package trgovina.ep.ep_trgovina.models;

import java.io.Serializable;

/**
 * Created by miha on 1.1.2018.
 */

public class Posta implements Serializable {

    public int postna_st;

    public String naziv;

    @Override
    public String toString() {
        return "Posta{" +
                "postna_st=" + postna_st +
                ", naziv='" + naziv + '\'' +
                '}';
    }
}
