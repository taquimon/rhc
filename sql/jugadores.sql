SELECT j.name, j.last, j.ci, j.fechanacimiento, j.parentesco, j.kardex, j.documento, j.notas, c.name AS club
FROM jugador j
LEFT JOIN club AS c ON c.idClub = j.idClub
WHERE j.disciplina =1
ORDER BY c.name