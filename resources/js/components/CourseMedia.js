import React from "react";
import VideoPlayer from "./VideoPlayer";
//import PDFViewer from "pdf-viewer-reactjs";

const Video = ({ lecture }) => (
  <div className="media-video col mb-5 mt-4 d-flex align-items-center justify-content-center">
    <VideoPlayer
      {...{
        autoplay: false,
        controls: true,
        responsive: true,
        fill: true,
        sources: [
          {
            src: `${storage_url}/${lecture.course_id}/${lecture.video_title}.${lecture.video_type}`,
            type: "video/mp4",
          },
        ],
      }}
    />
  </div>
);

const Audio = ({ lecture }) => (
  <div className="media-audio col mt-4 d-flex align-items-center justify-content-center">
    <audio
      onContextMenu={(e) => e.preventDefault()}
      controls
      controlsList="nodownload"
    >
      <source
        src={`${storage_url}/${lecture.course_id}/${lecture.file_name}.${lecture.file_extension}`}
        type="audio/mpeg"
      />
    </audio>
  </div>
);

const Document = ({ lecture }) => (
/* <div className="container col mb-5 mt-4">
  <PDFViewer
      navbarOnTop={true}
      protectContent={true}
      document={{ url: `${site_url}/readPDF/${lecture.media}` }}
    />
  </div>*/
  <div></div>
);

const PlainText = ({ lecture }) => (
  <div className="media-text col mt-4">
    <div dangerouslySetInnerHTML={{ __html: lecture.contenttext }} />
  </div>
);

const Media = (props) => {
  const mediaTypes = [
    <Video {...props} />,
    <Audio {...props} />,
    <Document {...props} />,
    <PlainText {...props} />,
  ];

  return (
    <React.Fragment>{mediaTypes[props.lecture.media_type]}</React.Fragment>
  );
};

export default Media;
