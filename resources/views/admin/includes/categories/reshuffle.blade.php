<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Re-shuffle Categories</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('shuffle-categories') }}">
                <div class="modal-body">
                    @csrf
                        <div class="rankings">
                            <a href="#rankingsSkipEnd" class="skipLink" id="rankingsSkipStart">&darr; Jump to list end</a>
                            <ol>
                                <li aria-labelledby="marker1 name1" class="rankingsItemLowfi">
                                    <div id="marker1" class="rankingsItem--marker">1.</div>
                                    <div class="rankingsItem--inner">
                                        <div id="name1" class="rankingsItem--text">Apple</div>
                                        <img class="rankingsItem--photo" src="https://assets.codepen.io/128542/apple.png" width="72" height="72" alt="" />
                                        <div class="rankingsItem--moveGroup">
                                            <label for="move1">Move <span class="visuallyHidden">Apple </span> to:</label>
                                            <input type="text" id="move1" inputmode="numeric" pattern="[0-9]*" autocomplete="off" />
                                        </div>
                                    </div>
                                </li>
                                <li aria-labelledby="marker2 name2" class="rankingsItemLowfi">
                                    <div id="marker2" class="rankingsItem--marker">2.</div>
                                    <div class="rankingsItem--inner">
                                        <div id="name2" class="rankingsItem--text">Banana</div>
                                        <img class="rankingsItem--photo" src="https://assets.codepen.io/128542/banana.png" width="96" height="auto" alt="" />
                                        <div class="rankingsItem--moveGroup">
                                            <label for="move2">Move <span class="visuallyHidden">Banana </span> to:</label>
                                            <input type="text" id="move2" inputmode="numeric" pattern="[0-9]*" autocomplete="off" />
                                        </div>
                                    </div>
                                </li>
                                <li aria-labelledby="marker3 name3" class="rankingsItemLowfi">
                                    <div id="marker3" class="rankingsItem--marker">3.</div>
                                    <div class="rankingsItem--inner">
                                        <div id="name3" class="rankingsItem--text">Cherry</div>
                                        <img class="rankingsItem--photo" src="https://assets.codepen.io/128542/cherry.png" width="96" height="auto" alt="" />
                                        <div class="rankingsItem--moveGroup">
                                            <label for="move3">Move <span class="visuallyHidden">Cherry </span> to:</label>
                                            <input type="text" id="move3" inputmode="numeric" pattern="[0-9]*" autocomplete="off" />
                                        </div>
                                    </div>
                                </li>
                                <li aria-labelledby="marker4 name4" class="rankingsItemLowfi">
                                    <div id="marker4" class="rankingsItem--marker">4.</div>
                                    <div class="rankingsItem--inner">
                                        <div id="name4" class="rankingsItem--text">Grape</div>
                                        <img class="rankingsItem--photo" src="https://assets.codepen.io/128542/grape.png" width="96" height="auto" alt="" />
                                        <div class="rankingsItem--moveGroup">
                                            <label for="move4">Move <span class="visuallyHidden">Grape </span> to:</label>
                                            <input type="text" id="move4" inputmode="numeric" pattern="[0-9]*" autocomplete="off" />
                                        </div>
                                    </div>
                                </li>
                                <li aria-labelledby="marker5 name5" class="rankingsItemLowfi">
                                    <div id="marker5" class="rankingsItem--marker">5.</div>
                                    <div class="rankingsItem--inner">
                                        <div id="name5" class="rankingsItem--text">Orange</div>
                                        <img class="rankingsItem--photo" src="https://assets.codepen.io/128542/orange.png" width="96" height="auto" alt="" />
                                        <div class="rankingsItem--moveGroup">
                                            <label for="move5">Move <span class="visuallyHidden">Orange </span> to:</label>
                                            <input type="text" id="move5" inputmode="numeric" pattern="[0-9]*" autocomplete="off" />
                                        </div>
                                    </div>
                                </li>
                            </ol>
                            <a href="#rankingsSkipStart" class="skipLink" id="rankingsSkipEnd">&uarr; Jump to list start</a>

                            <div class="buttonRowRight">
                                <button id="updateBtn" class="button buttonSecondary" type="submit" name="update">Update List</button>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
