# Citation for the BFI-2
# Soto, C. J., & John, O. P. (2017). The next Big Five Inventory (BFI-2): Developing and assessing a hierarchical model with 15 facets to enhance bandwidth, fidelity, and predictive power. Journal of Personality and Social Psychology, 113, 117-143.

question = [
    ("1. Is outgoing, sociable","E_"),
    ("2. Is compassionate, has a soft heart", "A_"),
    ("3. Tends to be disorganized","C_-"),
    ("4. Is relaxed, handles stress well", "N_-"),
    ("5. Has few artistic interests", "O_-"),
    ("6. Has an assertive personality","E_"),
    ("7. Is respectful, treats others with respect","A_"),
    ("8. Tends to be lazy","C_-"),
    ("9. Stays optimistic after experiencing a setback","N_-"),
    ("10. Is curious about many different things","O_"),
    ("11. Rarely feels excited or eager","E_-"),
    ("12. Tends to find fault with others","A_-"),
    ("13. Is dependable, steady","C_"),
    ("14. Is moody, has up and down mood swings","N_"),
    ("15. Is inventive, finds clever ways to do things","O_"),
    ("16. Tends to be quiet","E_-"),
    ("17. Feels little sympathy for others","A_-"),
    ("18. Is systematic, likes to keep things in order","C_"),
    ("19. Can be tense","N_"),
    ("20. Is fascinated by art, music, or literature","O_"),
    ("21. Is dominant, acts as a leader","E_"),
    ("22. Starts arguments with others","A_-"),
    ("23. Has difficulty getting started on tasks","C_-"),
    ("24. Feels secure, comfortable with self","N_-"),
    ("25. Avoids intellectual, philosophical discussions","O_-"),
    ("26. Is less active than other people","E_-"),
    ("27. Has a forgiving nature","A_"),
    ("28. Can be somewhat careless","C_-"),
    ("29. Is emotionally stable, not easily upset","N_-"),
    ("30. Has little creativity","O_-"),
    ("31. Is sometimes shy, introverted","E_-"),
    ("32. Is helpful and unselfish with others","A_"),
    ("33. Keeps things neat and tidy","C_"),
    ("34. Worries a lot","N_"),
    ("35. Values art and beauty","O_"),
    ("36. Finds it hard to influence people","E_-"),
    ("37. Is sometimes rude to others","A_-"),
    ("38. Is efficient, gets things done","C_"),
    ("39. Often feels sad","N_"),
    ("40. Is complex, a deep thinker","O_"),
    ("41. Is full of energy","E_"),
    ("42. Is suspicious of others’ intentions","A_-"),
    ("43. Is reliable, can always be counted on","C_"),
    ("44. Keeps their emotions under control","N_-"),
    ("45. Has difficulty imagining things","O_-"),
    ("46. Is talkative","E_"),
    ("47. Can be cold and uncaring","A_-"),
    ("48. Leaves a mess, doesn’t clean up","C_-"),
    ("49. Rarely feels anxious or afraid","N_-"),
    ("50. Thinks poetry and plays are boring","O_-"),
    ("51. Prefers to have others take charge","E_-"),
    ("52. Is polite, courteous to others","A_"),
    ("53. Is persistent, works until the task is finished","C_"),
    ("54. Tends to feel depressed, blue","N_"),
    ("55. Has little interest in abstract ideas","O_-"),
    ("56. Shows a lot of enthusiasm","E_"),
    ("57. Assumes the best about people","A_"),
    ("58. Sometimes behaves irresponsibly","C_-"),
    ("59. Is temperamental, gets emotional easily","N_"),
    ("60. Is original, comes up with new ideas","O_")
]

# BFI-2 Domain Scales
# Extraversion: 1, 6, 11R, 16R, 21, 26R, 31R, 36R, 41, 46, 51R, 56
# Agreeableness: 2, 7, 12R, 17R, 22R, 27, 32, 37R, 42R, 47R, 52, 57
# Conscientiousness: 3R, 8R, 13, 18, 23R, 28R, 33, 38, 43, 48R, 53, 58R
# Negative Emotionality: 4R, 9R, 14, 19, 24R, 29R, 34, 39, 44R, 49R, 54, 59
# Open-Mindedness: 5R, 10, 15, 20, 25R, 30R, 35, 40, 45R, 50R, 55R, 60



table = "<table><p><b>I am someone who...</b></p>"
table += "<p style='text-align:left'>Here are a number of characteristics that may or may not apply to you. Please indicate the extent to which you agree or disagree with that statement.</p>"
table += "<br><br><p style='text-align:center'>I am someone who...</p>"
q_number = 1

for tuple in question:
    text = tuple[0]
    index = tuple[1]
    table += "<tr><td>"+ text + "</td><td>"
    table += "<input name='Big5_Q" + str(q_number) +"' type='radio' value='" + index + "1' class='obligatory' required='required' id='" + index + "1' />"
    table += "<label for='" + index + "1'> Disagree strongly </label><br />"
    table += "<input name='Big5_Q" + str(q_number) +"' type='radio' value='" + index + "2' class='obligatory' required='required' id='" + index + "2' />"
    table += "<label for='" + index + "2'> Disagree a  little </label><br />"
    table += "<input name='Big5_Q" + str(q_number) +"' type='radio' value='" + index + "3' class='obligatory' required='required' id='" + index + "3' />"
    table += "<label for='" + index + "3'> Neither agree nor disagree </label><br />"
    table += "<input name='Big5_Q" + str(q_number) +"' type='radio' value='" + index + "4' class='obligatory' required='required' id='" + index + "4' />"
    table += "<label for='" + index + "4'> Agree a little </label><br />"
    table += "<input name='Big5_Q" + str(q_number) +"' type='radio' value='" + index + "5' class='obligatory' required='required' id='" + index + "5' />"
    table += "<label for='" + index + "5'> Agree strongly </label><br />"
    table += "<br /><br /></td></tr>"
    q_number += 1

table += "</table>"
print(table)


					# <tr>
					# 	<td>
					# 		Question
					# 	</td>
					# 	<td>
					# 		<input name='Big5_Q1' type='radio' value='1' class='obligatory' required='required' id='1' />
					# 		<label for='1'>
					# 				Disagree strongly
					# 			</label>
					# 		<br />
					# 		<input name='Big5_Q1' type='radio' value='2' class='obligatory' required='required' id='2' />
					# 		<label for='2'>
					# 				Disagree a little
					# 			</label>
					# 		<br />
                    #         <input name='Big5_Q1' type='radio' value='3' class='obligatory' required='required' id='3' />
					# 		<label for='3'>
					# 				Neutral; no opinion
					# 			</label>
					# 		<br />
                    #         <input name='Big5_Q1' type='radio' value='4' class='obligatory' required='required' id='4' />
					# 		<label for='4'>
					# 				Agree a little
					# 			</label>
					# 		<br />
                    #         <input name='Big5_Q1' type='radio' value='5' class='obligatory' required='required' id='5' />
					# 		<label for='5'>
					# 				Agree strongly
					# 			</label>
					# 		<br />
					# 		<br />
					# 		<br />
					# 		<br />
					# 	</td>
					# </tr>
