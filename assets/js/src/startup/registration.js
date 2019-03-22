
import ReactOnRails from "react-on-rails";
import CamieApp from "./CamieApp";
import configureStore from "../store/ChildrenStore";

const childrenStore = configureStore;

ReactOnRails.registerStore({ childrenStore });
ReactOnRails.register({ CamieApp });
