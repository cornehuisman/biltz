<div class="social-feed-element {{=it.social_network}} {{? !it.moderation_passed}}hidden{{?}} {{?it.has_video}}has-video{{?}} col-xs-12 col-sm-6 col-md-4 col-lg-4" data-toggle="modal" data-target="zz-{{=it.id}}" dt-create="{{=it.dt_create}}" social-feed-id="{{=it.id}}">
    <div class="wrapper">
        <div class="attachment" >
            <div class="type-of-social"><i class="fa fa-{{=it.social_network}}"></i></div>
            <div class="image" style="background-image:url('{{=it.attachment}}')">
                <div class="icon"></div>
            </div>
        </div>

        <div class='content'>
            <div class="content-items">
                <span class="muted"> {{=it.time_ago}}</span>
                <div class='text-wrapper'>
                    <p class="social-feed-text">{{=it.text}}</p>
                </div>
                <div class="info">
                    {{? it.num_likes}}
                        <div class="likes-count"><span class="count">{{=it.num_likes.total_count}}</span><span class="text">likes</span></div>
                    {{?}}
                    {{? it.num_comments}}
                        <div class="comments-count"><span class="count">{{=it.num_comments.total_count}}</span><span class="text">reactie(s)</span></div>
                    {{?}}
                </div>
            </div>
        </div>
    </div>



    <div id="zz-{{=it.id}}" class="modal fade modal-container-content" role="dialog">
        <div class="modal-dialog {{=it.social_network}} {{?it.has_video}}has-video{{?}}">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="attachment" {{?it.video_src}}data-video-src="{{=it.video_src}}"{{?}}>
                        <div class="type-of-social"><i class="fa fa-{{=it.social_network}}"></i></div>
                        {{?it.has_video}}
                            <div class="image" style="background-image:url('{{=it.attachment}}')">

                            </div>
                        {{?}}

                        {{?!it.has_video}}
                            <div class="object-fit__container">
                                <img class="image" src="{{=it.attachment}}"/>
                            </div>
                            <div class="icon"></div>
                        {{?}}
                    </div>


                    <div class='content'>
                        <div class="content-items">
                            <span class="muted"> {{=it.time_ago}}</span>
                            <div class='text-wrapper'>
                                <p class="social-feed-text">{{=it.message}} {{?it.description}}{{=it.description}}{{?}}</p>
                            </div>
                            {{?it.link}}
                                <a href="{{=it.link}}" target="_blank" class="button">
                                    Bekijk meer
                                </a>
                            {{?}}
                            <div class="info">
                                {{? it.num_likes}}
                                    <div class="likes-count"><span class="count">{{=it.num_likes.total_count}}</span><span class="text">likes</span></div>
                                {{?}}
                                {{? it.num_comments}}
                                    <div class="comments-count"><span class="count">{{=it.num_comments.total_count}}</span><span class="text">reactie(s)</span></div>
                                {{?}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
