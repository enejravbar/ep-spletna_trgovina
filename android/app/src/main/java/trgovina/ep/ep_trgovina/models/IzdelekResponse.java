package trgovina.ep.ep_trgovina.models;

import java.io.Serializable;
import java.util.List;

/**
 * Created by miha on 1.1.2018.
 */

public class IzdelekResponse implements Serializable {

    public Izdelek izdelek;

    public List<Slika> slike;

    @Override
    public String toString() {
        return "IzdelekResponse{" +
                "izdelek=" + izdelek +
                ", slike=" + slikeToString() +
                '}';
    }

    private String slikeToString(){
        StringBuilder sb = new StringBuilder();
        sb.append("[ ");
        boolean prva = true;
        for(Slika s : slike){
            if(prva){
                prva = false;
                sb.append(s.naziv);
            } else {
                sb.append(", ");
                sb.append(s.naziv);
            }
        }
        sb.append("]");
        return sb.toString();
    }
}
