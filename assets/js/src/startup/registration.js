
import ReactOnRails from "react-on-rails";
import CamieApp from "./CamieApp";
import configureStore from "../store/CamieStore";

const CamieStore = configureStore;

ReactOnRails.registerStore({ CamieStore });
ReactOnRails.register({ CamieApp });
