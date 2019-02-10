<section class="main">
    <div class="main-content bg-fix clearfix">
        <div class="container">
        
            <div class="account">
                <div class="account-left">
                    <?php $pageSelected = 'sent'; require_once 'includes/account-sidebar.php'; ?>
                </div>

                <div class="account-right">
                    <div class="messages-inner slate">
                        <h1>Sent</h1>

                        <?php if(Input::get('read') == null): ?>
                        <div class="messages-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="from">To</th>
                                        <th class="subject">Subject</th> 
                                        <th class="date">Sent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($message->getSentMessages()->count()):
                                    foreach($message->getSentMessages()->results() as $m):
                                    ?>
                                    <tr>
                                        <td class="from"><a href="<?php echo '/user/' . $user->get($m->recipient_user_id)->username; ?>"><?php echo $user->get($m->recipient_user_id)->name; ?></a></td>
                                        <td class="subject"><a href="?read=<?php echo $m->id ?>"><?php echo escape($m->subject); ?></a></td>
                                        <td class="date"><abbr class="timeago" title="<?php echo date(DATE_ISO8601, strtotime($m->date)); ?>"></td>
                                    </tr>
                                    <?php
                                    endforeach;
                                else:
                                ?>
                                    <tr class="no-messages">
                                        <td colspan="4">
                                            <div class="icon ion-sad-outline"></div>
                                            <div class="message">No messages to display</div>
                                        </td>
                                    </tr>
                                <?php
                                endif;
                                ?>
                                </tbody>
                            </table>
                        </div>

<!--                         <div class="messages-footer clearfix">
                            <div class="float-right">
                                <div class="pagination">
                                    <a href="" class="active">1</a>
                                    <a href="">2</a>
                                    <a href="">3</a>
                                </div>
                            </div>
                        </div> -->
                        <?php else:
                            if($showMessage):
                            $m = $message->get($read);
                            ?>
                            <div class="read-message">
                                <div class="message-header">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <img src="<?php echo USER_AVATAR_DIR . $user->get($m->sender_user_id)->avatar; ?>" alt="<?php echo escape($user->get($m->sender_user_id)->name); ?>">
                                        </div>
                                        <div class="float-left">
                                            <p><strong><span class="pre-name">To:</span> <a href="<?php echo '/user/' . $user->get($m->recipient_user_id)->username; ?>"><?php echo $user->get($m->recipient_user_id)->name; ?> <?php if($user->get($m->recipient_user_id)->verified): ?><span class="user-verified"><span class="ion-checkmark-circled"></span></span><?php endif; ?></a></strong></p>
                                            <p><span class="pre-name">From:</span> <a href="<?php echo '/user/' . $user->get($m->sender_user_id)->username; ?>"><?php echo $user->get($m->sender_user_id)->name; ?> <?php if($user->get($m->sender_user_id)->verified): ?><span class="user-verified"><span class="ion-checkmark-circled"></span></span><?php endif; ?></a></p>
                                        </div>
                                    </div>
                                    <p class="subject"><?php echo escape($m->subject); ?><span class="float-right text-grey">Sent <abbr class="timeago" title="<?php echo date(DATE_ISO8601, strtotime($m->date)); ?>"></span></p>
                                </div>
                                <div class="message-body">
                                    <p><?php echo Hashmention::parse(linkify(nl2br(escape($m->message)))); ?></p>
                                </div>
                                <div class="message-footer clearfix">
                                    <div class="float-left">
                                        <a href="/messages/sent" class="button button-boring button-tiny"><span class="ion-chevron-left">&nbsp;</span> Back to Sent</a>
                                    </div>
                                    <div class="float-right">
                                        <!-- <?php //if($m->seen): ?>&nbsp;<span class="button button-success button-tiny"><span class="ion-checkmark"></span> Read</span><?php //else: ?>&nbsp;<span class="button button-gold button-tiny"><span class="ion-clock"></span> Not yet read</span><?php //endif; ?> -->
                                    </div>
                                </div>
                            </div>
                            <?php
                            endif;
                        endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>