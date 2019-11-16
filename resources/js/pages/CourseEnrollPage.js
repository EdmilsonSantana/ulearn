import React from "react";
import { render } from "react-dom";
import { BrowserRouter as Router, Route } from "react-router-dom";

import { library } from "@fortawesome/fontawesome-svg-core";
//import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";

import {
  faAngleDoubleRight,
  faCheck,
  faArrowLeft,
  faDownload,
  faPaperclip,
  faExternalLinkAlt
} from "@fortawesome/free-solid-svg-icons";

library.add(
  faAngleDoubleRight,
  faCheck,
  faArrowLeft,
  faDownload,
  faPaperclip,
  faExternalLinkAlt
);

import Master from "../components/Master";
//import Footer from "../components/Footer";

if (document.getElementById("course-enroll-container")) {
  require("bootstrap/dist/css/bootstrap.css");
  require("../site.css");

  render(
    <Router>
      <Route path={base_url + "/:l_slug"} component={Master} />
    </Router>,
    document.getElementById("course-enroll-container")
  );
}
