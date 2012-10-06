var currentThrow = null;
var $currentThrow = null;

$(document).ready(function(){
  
    var editingGame = 0;
    var allowEditStateChange = 1;
    var editGame = null;
    var pinMode = 0;
  
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
    
    /**
     * Edit String's comments and practice
     */
    $("#content").on("click",".corner-button",function(event) {
        var $popup = $(this).find(">:first-child");
       
        $popup.fadeIn(200);
        event.stopPropagation();
    });
  
    /*
     * Edit a Game
     */
    $("#content").on("click", ".edit-game a", function(event) {
        event.preventDefault();
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
            var get_url = $(this).attr('href');
            $.ajax({
                type : "GET",
                url : get_url,
            
                success:function(response) {
                    var json = JSON.parse(response);
                    if (json.success) {
                        editGame = json.game;
                        initGame(editGame);
                    }
                },
            
                error:function(error) {
                    alert(error.message);
                }
            });            
            $bowlerContent.fadeToggle(100, null, function() {
                $("#game_"+gameId+" .edit-game a").html("Save");
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
    
    $("#swap_mode").click(function() {
        if (pinMode == 0) {
            $("#pin_editor").animate({
                height:"show"
            });
            $(".show-for-pins").show();
            $(".show-for-score").hide();
            pinMode = 1;
        } else {
            $("#pin_editor").animate({
                height:"hide"
            });
            $(".show-for-pins").hide();
            $(".show-for-score").show();
            pinMode = 0;
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
        $(".corner-button>:first-child").fadeOut(200);
    });
  
    $("#content").on("click",".add-bowler-to-game > ul", function(event) {
        event.stopPropagation();
    });
    
    $(".pin-button").click(function(event) {
        event.preventDefault();
        $(this).toggleClass("pin-up").toggleClass("pin-down");
    });
});

function getPinString() {
    var string = "";
    for (var i = 1; i <=10; i++) {
        if ($("#pin_"+i).hasClass("pin-up")) {
            string += "0";  // pin wasn't knocked down.
        } else {            
            string += "1";  // pin was knocked down.
        }
    }
    return string;
}

function initGame(game) {
    var $game = $("game_"+game.id);
    for (var i = 0; i < game.strings.length; i++) {
        var string = game.strings[i];
        var $string = $("string_"+game.strings[i].id);
        $("#string_comments_"+string.id).val(string.comments);
        $("#string_practice_"+string.id).prop("checked", string.practice);
        for (var j = 0; j < string.frames.length; j++) {
            var frame = string.frames[i];
            for (var k = 0; k < frame["throws"].length; k++) {
                var bThrow = frame["throws"][k];
                var $link = $('#string_'+string.id+'_frame_'+(j+1)+'_throw_'+k+' a');
                console.log($link);
                if (bThrow.state == 0) {            //NEW_THROW
                    $link.html("?");
                } else if (bThrow.state == 1) {     //FIRST
                    $link.html(bThrow.score);
                } else if (bThrow.state == 2) {     //STRIKE
                    $link.html("X");
                } else if (bThrow.state == 3) {     //SPARE
                    $link.html("/");
                } else if (bThrow.state == 4) {     //OPEN
                    if (bThrow.score == 0) {
                        $link.html("-");
                    } else {
                        $link.html(bThrow.score);
                    }
                } else if (bThrow.state == 5) {     //TENTH
                    
                }
            }
        }
    }
}