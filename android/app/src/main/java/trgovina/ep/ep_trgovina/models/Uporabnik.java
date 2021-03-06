package trgovina.ep.ep_trgovina.models;

import java.io.Serializable;

/**
 * Created by miha on 31.12.2017.
 */

public class Uporabnik implements Serializable {

    public long id;

    public int vloga;

    public String ime;

    public String priimek;

    public String email;

    public String geslo;

    public String naslov;

    public String telefon;

    public int posta;

    public int status;

    @Override
    public String toString() {
        return "Uporabnik{" +
                "id=" + id +
                ", vloga=" + vloga +
                ", ime='" + ime + '\'' +
                ", email='" + email + '\'' +
                ", naslov='" + naslov + '\'' +
                ", posta=" + posta +
                ", telefon=" + telefon +
                ", status=" + status +
                '}';
    }
}
