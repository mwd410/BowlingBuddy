$(document).ready(function(){
  
    var editingGame = 0;
    var allowEditStateChange = 1;
  
    /*
     * Add a Session
     */
    $("#content").on("click", "#create-session", function(event) {
        event.preventDefault();
        if (editingGame == 1) {
            return;
        }
        var bowlerId = $(this).attr("bowler");
        var post_url = $(this).attr("href");
    
        $.ajax({
            type: "POST",
            url: post_url,
            data: {
                "bowlerId" : bowlerId
            },
            
            success:function(response) {
                $("#sessions").prepend($(response).fadeIn());
            },
            
            error:function() {
                aler("error creating session");
            }
        });
    });
  
    /*
     * Select Bowler
     */
    $("#bowler-select").hover(function(event) {
        event.preventDefault();
        $("#bowler-select ul").animate({
            height:"show"
        }, 100);
    }, function() {
        $("#bowler-select ul").animate({
            height:"hide"
        }, 100);
    });
  
    /*
     * Expand/Contract a session 
     */
    $("#content").on("click", ".session-title a", function() {
        if (editingGame == 1) {
            return;
        }
        var sessionId = $(this).attr("sessionId");
        $("#session_details_wrapper_"+sessionId).slideToggle();
        $(".session-details-wrapper").each(function() {
            if ($(this).attr("sessionId") != sessionId) {
                $(this).animate({
                    height:"hide"
                });
            }
        });
    });
  
    /*
     * Add a Game
     */
    $("#content").on("click", ".add-game", function(event) {
        event.preventDefault();
        if (editingGame == 1) {
            return;
        }
        var sessionId = $(this).attr("sessionId");
        var postUrl = $(this).attr("href");

        $.ajax({
            type: "POST",
            url: postUrl,
            data: {
                "sessionId" : sessionId
            },
      
            success:function(response) {
                $("#games_"+sessionId).append($(response).fadeIn());
            },
      
            error:function() {
                alert("Could not create game.");
            }
        });
    });
  
    /*
     * Edit a Game
     */
    $("#content").on("click", ".edit-game a", function() {
        if (allowEditStateChange == 0) {
            return;
        }
    
        allowEditStateChange = 0;
        var sessionId = $(this).attr("sessionId");
        var gameId = $(this).attr("gameId");
        var $bowlerDiv = $("#session_details_wrapper_"+sessionId+" .session-bowlers");
        var $bowlerContent = $("#session_details_wrapper_"+sessionId+" .session-bowlers div");
        var $gamesHeader = $("#game_list_header_"+sessionId);
        var $gameDetails = $("#game_"+gameId+" .game-details");
        if (editingGame == 0) {
            $bowlerContent.fadeToggle(100, null, function() {
                $("#game_"+gameId+" .edit-game a").html("Done");
                $gamesHeader.animate({
                    height:'hide'
                });
                $bowlerDiv.animate({
                    width:['hide', 'easeInQuad']
                }, null,  function() {
                    $gameDetails.animate({
                        height:'show'
                    });
                    allowEditStateChange = 1;
                });
        
                $("#session_"+sessionId+" .game").each(function() {
                    if ($(this).attr("id") != "game_"+gameId) {
                        $(this).children().animate({
                            opacity:["hide", 'easeOutQuad']
                        });
                        $(this).animate({
                            height:["hide", 'easeOutQuad']
                        });
                    }
                });
            });
            editingGame = 1;
        } else {
            $gameDetails.animate({
                height:'hide'
            }, null, null, function() {
                $("#game_"+gameId+" .edit-game a").html("Edit");
                $gamesHeader.animate({
                    height:'toggle'
                });
                $bowlerDiv.animate({
                    width:['show', 'easeOutQuad']
                },null,null,function() {
                    $bowlerContent.fadeToggle(100, null,  function() {
                        allowEditStateChange = 1;
                    });
                });
      
                $("#session_"+sessionId+" .game").each(function() {
                    if ($(this).attr("id") != "game_"+gameId) {
                        $(this).children(".game-header").animate({
                            opacity:["show", 'easeInQuad']
                        });
                        $(this).animate({
                            height:["show", "easeInQuad"]
                        });
                    }
                });
                editingGame = 0;
            });
        }
    
    });
  
  
    $("#content").on("click",".add-bowler-to-game > a", function(event) {
        var gameId = $(this).attr("gameId");
        var $list = $("#add_bowler_to_game_"+gameId+" ul");
    
        event.stopPropagation();
        $list.animate({
            height:"toggle"
        }, 200);
    });
  
    $("body").click(function() {
        $(".add-bowler-to-game > ul").animate({
            height:"hide"
        },200);
    });
  
    $("#content").on("click",".add-bowler-to-game > ul", function(event) {
        event.stopPropagation();
    });
});