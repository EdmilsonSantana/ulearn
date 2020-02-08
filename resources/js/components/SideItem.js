import React, { Component } from "react";
import {
  BrowserRouter as Router,
  Route,
  NavLink,
  Link,
  useLocation
} from "react-router-dom";
import Checkbox from './Checkbox';
import LectureService from "../services/LectureService";

const SideItem = (props) => {

  const service = new LectureService(site_url);
  const lecture = props.lecture;

  const handleChange = (event) => {
    this.setState({ checked: event.target.checked });
  };

  const getNavLinkClass = (path) => {
    return useLocation().pathname === path ? 'active' : '';
  }

  if (lecture.is_section) {
    return (
      <li className="site-menu-category">
        Seção {lecture.number} - {lecture.s_title}
      </li>
    );
  } else {
    let linkUrl = `${base_url}/${lecture.url}`;

    return (
      <li className={`site-menu-item d-flex flex-row align-items-center ${getNavLinkClass(linkUrl)}`}>
        <NavLink to={linkUrl}>
          <article>
            <div className="pl-2">
              Atividade {lecture.number}:{" "}
              {lecture.l_title}
            </div>
          </article>
        </NavLink>
        <div className="ml-auto">
          <Checkbox id={lecture.number}
            initialChecked={lecture.completion_status}
            onChange={checked => service.updateLectureStatus(lecture, checked)} />
        </div>
      </li>
    );
  }
}

export default SideItem;
