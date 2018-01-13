package trgovina.ep.ep_trgovina.models;

import java.io.Serializable;
import java.util.Date;

/**
 * Created by miha on 31.12.2017.
 */

public class Izdelek implements Serializable {

    public long id;

    public int kategorija;

    public String ime;

    public String opis;

    public double cena;

    public int status;

    public String dodan;

    @Override
    public String toString() {
        return "Izdelek{" +
                "id=" + id +
                ", kategorija=" + kategorija +
                ", ime='" + ime + '\'' +
                ", opis='" + opis + '\'' +
                ", cena=" + cena +
                ", status=" + status +
                '}';
    }
}
