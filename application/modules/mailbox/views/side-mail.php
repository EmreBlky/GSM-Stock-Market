<div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-content mailbox-content">
                        <div class="file-manager">
                            <!-- <a class="btn btn-block btn-primary compose-mail" href="mail_compose.html">Compose Mail</a> -->
                            <div class="space-25"></div>
                            <h5>Folders</h5>
                            <ul class="folder-list m-b-md" style="padding: 0">
                                <li style="border-bottom: none;">
                                    <i class="fa fa-inbox "></i> Inbox 
                                    <ul>
                                        <li><a href="mailbox/inbox/all">ALL <?php if($inbox > 0){ echo '<span class="label label-warning pull-right"><div id="inbox_all"></div></span>';}?></a></li>
                                        <li><a href="mailbox/inbox/member">From Members <?php if($member > 0){ echo '<span class="label label-warning pull-right"><div id="inbox_member"></div></span>';}?></a></li>
                                        <li><a href="mailbox/inbox/market">From Marketplace <?php if($market > 0){ echo '<span class="label label-warning pull-right"><div id="inbox_market"></div></span>';}?></a></li>
                                        <li><a href="mailbox/inbox/support">From Support <?php if($support > 0){ echo '<span class="label label-warning pull-right"><div id="inbox_support"></div></span>';}?></a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="mailbox/sent"> <i class="fa fa-envelope-o"></i> Sent Mail</a>
                                </li>
                                <li>
                                    <a href="mailbox/important"> <i class="fa fa-certificate"></i> Important</a>
                                </li>
                                <li>
                                    <a href="mailbox/archive"> <i class="fa fa-archive"></i> Archive</a>
                                </li>
                                <li>
                                    <a href="mailbox/draft"> <i class="fa fa-file-text-o"></i> Drafts <?php if($draft > 0){ echo '<span class="label label-danger pull-right">'.$draft.'</span>';}?></a>
                                </li>
                                <li>
                                    <a href="mailbox/trash"> <i class="fa fa-trash-o"></i> Trash</a>
                                </li>
                            </ul>
                            <!-- <h5>Categories</h5>
                            <ul class="category-list" style="padding: 0">
                                <li><a href="#"> <i class="fa fa-circle text-navy"></i> Work </a></li>
                                <li><a href="#"> <i class="fa fa-circle text-danger"></i> Documents</a></li>
                                <li><a href="#"> <i class="fa fa-circle text-primary"></i> Social</a></li>
                                <li><a href="#"> <i class="fa fa-circle text-info"></i> Advertising</a></li>
                                <li><a href="#"> <i class="fa fa-circle text-warning"></i> Clients</a></li>
                            </ul>

                            <h5 class="tag-title">Labels</h5>
                            <ul class="tag-list" style="padding: 0">
                                <li><a href=""><i class="fa fa-tag"></i> Family</a></li>
                                <li><a href=""><i class="fa fa-tag"></i> Work</a></li>
                                <li><a href=""><i class="fa fa-tag"></i> Home</a></li>
                                <li><a href=""><i class="fa fa-tag"></i> Children</a></li>
                                <li><a href=""><i class="fa fa-tag"></i> Holidays</a></li>
                                <li><a href=""><i class="fa fa-tag"></i> Music</a></li>
                                <li><a href=""><i class="fa fa-tag"></i> Photography</a></li>
                                <li><a href=""><i class="fa fa-tag"></i> Film</a></li>
                            </ul> -->
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
