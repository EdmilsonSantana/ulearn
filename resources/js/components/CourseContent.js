import React, { Component } from 'react';
import { BrowserRouter as Router, Route, NavLink } from "react-router-dom";

import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faArrowRight, faArrowLeft} from "@fortawesome/free-solid-svg-icons";


export default class CourseContent extends Component {
    constructor(props) {
        super(props);
        this.state = { is_completed: null };
    }
    handleClick() {
        axios.get(site_url + '/update-lecture-status/' + this.props.lecture.course_id + '/' + this.props.lecture.lecture_quiz_id + '/' + !this.state.is_completed)
            .then(response => {
                this.setState({ is_completed: !this.state.is_completed });
            })
            .catch(function (error) {
                console.log(error);
                // return window.location.href = site_url+'/login';
            })
    }
    componentWillReceiveProps(nextProps) {
        if (nextProps.lecture.lecture_quiz_id != this.props.lecture.lecture_quiz_id) {
            this.setState({ is_completed: nextProps.lecture.completion_status });
        }
    }

    lectureFile() {
        if (this.props.lecture.media_type == 0) {
            return (
                <div className="col d-flex align-items-center justify-content-center">
                    <video controls>
                        <source src={storage_url + "/" + this.props.lecture.course_id + "/" + this.props.lecture.video_title + "." + this.props.lecture.video_type} type="video/mp4" />
                    </video>
                </div>
            );
        } else if (this.props.lecture.media_type == 1) {
            return (
                <div className="col d-flex align-items-center justify-content-center">
                    <audio controls>
                        <source src={storage_url + "/" + this.props.lecture.course_id + "/" + this.props.lecture.file_name + "." + this.props.lecture.file_extension} type="audio/mpeg" />
                    </audio>
                </div>
            );
        } else if (this.props.lecture.media_type == 2) {
            return (
                <div className="col mt-4">
                    <iframe src={site_url + "/readPDF/" + this.props.lecture.media} width="100%" height="450px"></iframe>
                </div>
            );
        } else if (this.props.lecture.media_type == 3) {
            return (
                <div className="col mt-4">
                    <div dangerouslySetInnerHTML={{ __html: this.props.lecture.contenttext }} />
                </div>
            );
        }
    }
    render() {
        return (
            <div className="page-content container-fluid">

                <div className="row">
                    <div className="col-xl-6 col-md-12 col-sm-12 col-12">
                        <h1 className="page-title">{this.props.lecture.section_title}</h1>
                        <h4 className="lecture-title">{this.props.lecture.title}</h4>
                    </div>
                </div>

                <div className="row media-container">
                    {this.lectureFile()}
                </div>

                <div className="d-flex justify-content-between">
                    <div>
                        <NavLink className={`btn btn-learna btn-learna-primary ${!this.props.lecture.prev ? "disabled": ""}`} to={this.props.lecture.prev ? this.props.lecture.prev : '#'}><FontAwesomeIcon icon={faArrowLeft} /> Anterior</NavLink>
                    </div>
                    <div>
                        <NavLink className={`btn btn-learna btn-learna-primary ${!this.props.lecture.next ? "disabled": ""}`} to={this.props.lecture.next ? this.props.lecture.next : '#'}>Pŕoxima <FontAwesomeIcon icon={faArrowRight} /></NavLink>
                    </div>
                </div>

            </div>
        );
    }
}

