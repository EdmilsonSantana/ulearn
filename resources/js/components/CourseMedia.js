import React from 'react'
import VideoPlayer from './VideoPlayer';

const Video = ({ lecture }) => (
    <div className="col mb-5 mt-4 d-flex align-items-center justify-content-center">
        <VideoPlayer {...{
            autoplay: true,
            controls: true,
            responsive: true,
            fill: true,
            sources: [{
                src: `${storage_url}/${lecture.course_id}/${lecture.video_title}.${lecture.video_type}`,
                type: 'video/mp4'
            }]
        }} />
    </div>
);

const Audio = ({ lecture }) => (
    <div className="col mt-4 d-flex align-items-center justify-content-center">
        <audio controls>
            <source src={`${storage_url}/${lecture.course_id}/${lecture.file_name}.${lecture.file_extension}`} type="audio/mpeg" />
        </audio>
    </div>
);

const Document = ({ lecture }) => (
    <div className="col mb-5 mt-4">
        <iframe src={`${site_url}/readPDF/${lecture.media}`} width="100%" height="100%"></iframe>
    </div>
);

const PlainText = ({ lecture }) => (
    <div className="col mt-4">
        <div dangerouslySetInnerHTML={{ __html: lecture.contenttext }} />
    </div>
);

const Media = (props) => {

    const mediaTypes = [
        <Video {...props} />,
        <Audio {...props} />,
        <Document {...props} />,
        <PlainText {...props} />
    ];

    return (
        <React.Fragment>
            {mediaTypes[props.lecture.media_type]}
        </React.Fragment>
    );
};


export default Media;