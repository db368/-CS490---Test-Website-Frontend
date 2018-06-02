<html>
<style>
    .inline {
        display: inline;
    }

    .link-button {
        background: none;
        border: none;
        color: black;
        text-decoration: underline;
        cursor: pointer;
        font-size: 1em;
        font-family: serif;
    }

    .link-button:focus {
        outline: none;
    }

    .link-button:active {
        color: red;
    }
</style>

<head>
    <title> Qbank </title>
</head>

<body>
    <h1> Question Bank</h1>
    <p> Click on the question to edit it!</p>
    <div style="background-color:cyan">
        <table style ="width:100%">
            <tr>
                <th> Question</th>
                <th> Test Cases</th>
            </tr>
            <!--Begin Table Fun -->
            <tr> <th>
                <form method="post" action="http://afsaccess3.njit.edu/~db368/CS490/debug/debug.php" class="inline">
                    <input type="hidden" name="identifier" value="get_question"> </input>
                    <button type="submit" name="qid" value="39" class="link-button"> Write a method def Subtract(a,b) to subtract integer A from Integer B.   </button>
             </form>
         </th></tr>
        </table>
    </div>
    <!--End the button Nonsense -->
    <div>
        <a href="addq.php"> Add a new question </a>
    </div>
</body>
</html>
